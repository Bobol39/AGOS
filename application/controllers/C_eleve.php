<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_eleve extends CI_Controller
{

    protected $access = "admin,student";// --> Accesible aux ETUDIANTS
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */



    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper(array('form', 'url', 'text', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$this->load->model('m_eleve');
    }


    function index(){
        $this->load->view("v_header");
        $this->load->view("v_eleve_navbar");
        $this->load->view("v_eleve_index");
    }


    function saveResume(){
        $data["titre"] = $this->input->post('titre');
        $data["resume"] = $this->input->post('resume');
        $this->m_eleve->saveResume($data, $this->input->post('id_etudiant'));
    }

}
?>
