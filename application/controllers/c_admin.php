<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller
{

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
		$this->load->model('m_admin');
    }


    function index(){
        $this->load->view("v_header");
        $this->load->view("v_navbar_admin");
        $this->load->view("v_leftbar_admin");
        $this->load->view("v_admin_groupes");
    }


    function gestionProf(){
        $data["prof"] = $this->m_admin->getAllProf();
        $this->load->view("v_header");
        $this->load->view("v_navbar_admin");
        $this->load->view("v_leftbar_admin");
        $this->load->view("v_admin_gestion_prof",$data);
    }

    function showPlanning(){
        $data["salle"] = $this->m_admin->getSalle();

        $this->load->view("v_header");
        $this->load->view("v_navbar_admin");
        $this->load->view("v_leftbar_admin");
        $this->load->view("v_admin_planning",$data);
    }

    function saveAbreviation(){
        $data["array"] = $this->input->post('array');
        $decode = json_decode($data["array"]);
        $array = json_decode(json_encode($decode), True);

        $this->m_admin->saveAbreviation($array);
    }

    function gestionSalle(){
        $data["salle"] = $this->m_admin->getSalle();
        $this->load->view("v_header");
        $this->load->view("v_navbar_admin");
        $this->load->view("v_leftbar_admin");
        $this->load->view("v_admin_salle",$data);
    }

    function supprSalle(){
        $data["id"] = $this->input->post('id');
        $this->m_admin->supprSalle($data['id']);
    }

    function createSalle(){
        $data["nom"] = $this->input->post('nom');
        $this->m_admin->createSalle($data["nom"]);
    }

}
?>