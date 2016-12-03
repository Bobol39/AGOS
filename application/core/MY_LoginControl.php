<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_LoginControl extends CI_Controller  {

    /**
     * 'Admin' for admin
     * 'Teacher' for editor group
     * 'Student' for author group
     * @var string
     */
    protected $access = "Admin";


    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->login_check();
        if(isset($_REQUEST['logout'])){
            $this->logout();
        }
        $this->load->model('M_log');
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


        $response = $this->M_log->checkSave($uid);
        echo $response;
        if(true){//--------------> Ici vérifier si l'utilisateur est enregistrer en bdd

        }
        else{
            $this->get_ldap_info($uid);//----> Recupération des info utilisateur depuis le LDAP + mise en session des info recupérées
            //----------> ICI insérer l'utilisateur en BDD grâce aux info user du LDAP enregistrés en session

        }


        //TOUT UTILISATEUR CONNECTE EST CONSIDERER COMME UN ( Admin / Student / Teacher )
        $this->session->set_userdata('role', 'Admin');

        //AT this point user is logged in
        //we user is logged in check if he has permission to access this page

//        if (! $this->permission_check()) {
//            die("<h4>Access denied</h4>");
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


        //--------------------------> Recherche de l'utlisateur dans le LDAP
        $filter ="(uid=".$uid.")";
        //givenname = prenom, sn=nom, edupersonaffiliation=student ou teacher, mail= mail universitaire
        $justthese = array('givenname','sn','edupersonprimaryaffiliation','mail');
        $baseDn = "ou=people,dc=univ-fcomte,dc=fr";

        $result=ldap_list($connect, $baseDn, $filter, $justthese) or die("No search data found.");
        $info = ldap_get_entries($connect, $result);



        //Enregistrement des info utlisateur en session
        $this->session->set_userdata('role',info[0]["edupersonprimaryaffiliation"][0]);
        $this->session->set_userdata('nom',info[0]["sn"][0]);
        $this->session->set_userdata('prenom',info[0]["givenname"][0]);
        $this->session->set_userdata('mail',info[0]["mail"][0]);

        //Affichage des info utilisateur pour les tests uniquement
        echo "Nom: ".$this->session->sn . '<br />';
        echo "Prenom: ".$this->session->prenom. '<br />';
        echo "Type: ".$this->session->role. '<br />'; //rajouter [0] si c'est un array
        echo "Mail: ".$this->session->mail. '<br />';




    }

    //check if user's access is in the allowed userlist of this page
    public function permission_check()
    {
        //getting list of allowed users on this page
        $access = is_array($this->access) ? $this->access : explode(",", $this->access);

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

    public function logout(){
        phpCAS::logoutWithRedirectService('http://www.iut-bm.univ-fcomte.fr/');
    }
}

