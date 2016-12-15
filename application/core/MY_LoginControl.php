<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_LoginControl extends CI_Controller  {

    /**
     * 'admin' for admin
     * 'teacher' for techers
     * 'student' for students
     * @var string
     */
    protected $access = "admin,student,teacher";


    public function __construct()
    {
        parent::__construct();
        if(isset($_REQUEST['logout'])){//--> If logout go logout
            $this->logout();
        }
        $this->load->database();
        $this->load->library('session');
        $this->login_check();//--> A partir d'ici l'utilisateur est authenfié
        //  if la session existe ne pas recup les infos ldap et le mettre en session TODO
        $this->ldap_init();//----> Recupération des info utilisateur depuis le LDAP + mise en session des info recupérées
        if($this->session->role == false) {
            $this->put_user_in_session();
        }

        //TOUT UTILISATEUR CONNECTE EST CONSIDERER COMME UN ( Admin / Student / Teacher )
        //$this->session->set_userdata('role', 'Admin');//----> Dev only, not for production


        //check if user has permission to access this page as defined on the $access
        if (! $this->permission_check()) {
            die("<h4>Access denied</h4>");
        }
    }

    public function put_user_in_session(){
        $uid= $this->session->uid;
        $user = $this->get_user($uid);
        //Enregistrement des info utlisateur en session
        $this->session->set_userdata('role',$user[0]["edupersonprimaryaffiliation"][0]);
        $this->session->set_userdata('nom',$user[0]["sn"][0]);
        $this->session->set_userdata('prenom',$user[0]["givenname"][0]);
        $this->session->set_userdata('mail',$user[0]["mail"][0]);
        $this->session->set_userdata('nEtudiant',$user[0]["supannetuid"][0]);
        $this->session->set_userdata('etapeDiplome',$user[0]["ufclibelleetape"][0]);

        //echo 'user session '.$this->session->nom;
    }

    public function login_check()
    {
        $this->init_PHPCAS();
        // For production use set the CA certificate that is the issuer of the cert
        // phpCAS::setCasServerCACert($cas_server_ca_cert_path);

        phpCAS::setNoCasServerValidation();
        //----------->forceAuthentification force l'utilisateur à s'être connecté au CAS
        // Si l'utilisateur n'est pas connecté il est redirigé vers la page de connexion du cas: cas.univ-fcomte.fr
        phpCAS::forceAuthentication();
        //A partir d'ici, l'utilisateur est forcément connectée au CAS
        $uid = phpCAS::getUser();//On recupère le uid de l'utilisateur grâce au cas
        $this->session->set_userdata('uid', $uid);//On met le $uid en session pour cet utlisateur

//        ---> SI ON GARDE LA BDD ETUDIANTS CETTE PARTIE EST A DECOMMENTER (Model user/ check si user est en BDD sinon insert en BDD)

//        $this->load->model('M_log');
//        $response = $this->M_log->checkSave($uid);
//        if($response){ //Utilisateur non présent dans la database
//            $this->get_ldap_info($uid);//----> Recupération des info utilisateur depuis le LDAP + mise en session des info recupérées
//            //----------> ICI insérer l'utilisateur en BDD grâce aux info user du LDAP enregistrés en session
//            $this->M_log->saveUser();
//        }
    }

    public function get_ldap_info ($uid){

        // Initialisation des variables
        $ldaphost = "ldap://ldap.univ-fcomte.fr";  // votre serveur LDAP
        $ldapport = 903;
        $dn = 'uid=ihajali,ou=people,dc=univ-fcomte,dc=fr';
        $pass = 'yesadolyon00769*';

        $connect = ldap_connect($ldaphost,$ldapport);
        if($connect)
            echo '<p>connect ok</p>';
        else
            echo '<p>connect Nok</p>';

        if (ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3))
            echo '<p>Version LDAPv3</p>';
        else
            echo '<p>Impossible de modifier la version du protocole à 3</p>';

        if (ldap_set_option($connect, LDAP_OPT_REFERRALS, 0) )
            echo '<p>LDAP_OPT_REFERRALS ok</p>';
        else
            echo '<p>LDAP_OPT_REFERRALS Nok</p>';


        $bind = ldap_bind($connect, $dn, $pass);

        if($bind)
            echo '<p>bind ok</p>';
        else
            echo '<p>bind Nok</p>';


        //--------------------------> Recherche
        $filter ="(uid=".$uid.")";
        //givenname = prenom, sn=nom, edupersonaffiliation=student ou teacher, mail= mail universitaire
        $justthese = array('givenname','sn','edupersonprimaryaffiliation','mail');
        $baseDn = "ou=people,dc=univ-fcomte,dc=fr";

        $result=ldap_list($connect, $baseDn, $filter, $justthese) or die("No search data found.");
        $info = ldap_get_entries($connect, $result);

        //echo "Trouvé ".$info["count"];
//        for ($i=0; $i < $info["count"]; $i++) {
//            //Affichage des info utilisateur pour les tests uniquement
//            echo "Nom".$info[$i]["sn"][0] . '<br />';
//            echo "Prenom".$info[$i]["givenname"][0] . '<br />';
//            echo "Type".info[$i]["edupersonprimaryaffiliation"][0];
//            echo $info[$i]["mail"][0] . '<br />';
//            //Enregistrement des info utlisateur en session
//            $this->session->set_userdata('role',info[$i]["edupersonprimaryaffiliation"][0]);
//            $this->session->set_userdata('nom',info[$i]["sn"][0]);
//            $this->session->set_userdata('prenom',info[$i]["givenname"][0]);
//            $this->session->set_userdata('mail',info[$i]["edupersonprimaryaffiliation"][0]);
//        }



    }

    //check if user's access is in the allowed userlist of this page
    public function permission_check()
    {
        //getting list of allowed users on this page
        $this-> access = strtolower($this->access);//PUT $access to lower case
        $this->session->role = strtolower($this->session->role);//PUT user role to lower case


        $access = is_array($this->access) ? $this->access : explode(",", $this->access);
        echo "Mon role: ".$this->session->userdata("role")." Rôles de la page: ".$this->access;

        //check if user's access is in the allowed userlist of this page
        if (in_array($this->session->userdata("role"), array_map("trim", $access)) ) {
            return true;
        }

        return false;

    }

    public function init_PHPCAS(){
        // ---- Initialize phpCAS
        $CI =& get_instance();
        $this->CI = $CI;
        $CI->config->load('cas');
        $this->phpcas_path = $CI->config->item('phpcas_path');
        $this->cas_server_url = $CI->config->item('cas_server_url');

        // ---- init CAS client
        $defaults = array('path' => '', 'port' => 443);
        $cas_url = array_merge($defaults, parse_url($this->cas_server_url));

        if (empty($this->phpcas_path)
            or filter_var($this->cas_server_url, FILTER_VALIDATE_URL) === FALSE) {
            cas_show_config_error();
        }
        $cas_lib_file = $this->phpcas_path . '/CAS.php';
        if (!file_exists($cas_lib_file)){
            show_error("Could not find file: <code>" . $cas_lib_file. "</code>");
        }
        require_once $cas_lib_file;

        // END OF INIT PHPCAS

        // Enable debugging
        phpCAS::setDebug();
        // Enable verbose error messages. Disable in production!
        phpCAS::setVerbose(false);


        //Condition pour éviter de boucler entre cas et agos
        if($this->session->has_userdata('client') == null) {
            $this->session->set_userdata('client', phpCAS::client(CAS_VERSION_3_0, $cas_url['host'], $cas_url['port'], $cas_url['path'], false));
        }

    }

    public function get_user($uid){
        $filter = "(uid=".$uid.")";
        $user = $this->get_ldap_results($filter);
        return $user;
    }

    public function get_ldap_results($filter){
        //--------------------------> Recherche de l'utlisateur dans le LDAP
        //Gettinf ldap connection from session
        $connect = $this->session->connect;

        //Multple filters exemple:  (&(givenName=Benedikt)(telephoneNumber=1234567890))
        //$filter ="(&(ufclibellesecteurdisciplinaire=Informatique)(ufclibellecomposanteins=IUT de Belfort-Montbéliard))"; --> DUT +LP Resultats 715
        //givenname = prenom, sn=nom, edupersonaffiliation=student ou teacher, mail= mail universitaire
//        $justthese = array('givenname','sn','edupersonprimaryaffiliation','mail','supannetuid', 'ufclibellediplome', 'ufclibelleetape');
        $justthese = array('givenname','sn','edupersonprimaryaffiliation','mail','supannetuid', 'ufclibelleetape');
        $baseDn = "ou=people,dc=univ-fcomte,dc=fr";

        $result=ldap_list($connect, $baseDn, $filter, $justthese) or die("No search data found.");
        $info = ldap_get_entries($connect, $result);

        return $info;
    }

    public function logout(){
        phpCAS::logoutWithRedirectService('http://www.iut-bm.univ-fcomte.fr/');
    }

    public function ldap_init (){
        // Initialisation des variables
        $ldaphost = "ldap://ldap.univ-fcomte.fr";  // votre serveur LDAP
        $ldapport = 903;
        $dn = 'uid=ihajali,ou=people,dc=univ-fcomte,dc=fr';
        $pass = 'yesadolyon00769*';

        //if somethinf goes wrong with params return false
        $connect = ldap_connect($ldaphost,$ldapport);
        if(!$connect)
            return false;

        if (!ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3))
            return false;

        if (!ldap_set_option($connect, LDAP_OPT_REFERRALS, 0) )
            return false;


        $bind = ldap_bind($connect, $dn, $pass);

        if(!$bind)
            return false;

        $this->session->set_userdata('connect',$connect);
        //if everything went well return true
        return true;

    }

}

