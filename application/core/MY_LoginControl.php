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
    }

    public function login_check()
    {
        $this->init_PHPCAS();


        // For production use set the CA certificate that is the issuer of the cert
        // phpCAS::setCasServerCACert($cas_server_ca_cert_path);

        phpCAS::setNoCasServerValidation();
        phpCAS::forceAuthentication();

        //TOUT UTILISATEUR CONNECTE EST CONSIDERER COMME UN ( Admin / Student / Teacher )
        $this->session->set_userdata('role', 'Admin');

        //AT this point user is logged in
        //we user is logged in check if he has permission to access this page

        if (! $this->permission_check()) {
            die("<h4>Access denied</h4>");
        }

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

