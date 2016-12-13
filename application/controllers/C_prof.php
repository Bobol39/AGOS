<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_prof extends CI_Controller
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
        $this->load->model('m_prof');
    }

    public function index(){
        $login = "jfcouchot";
        $data["soutenances_tuteur"] = $this->m_prof->getSoutenancesByTutor($login);
        $data["soutenances_temoin"] = $this->m_prof->getSoutenancesByAssistant($login);
        $this->load->view('v_header');
        $this->load->view('v_prof_choix_soutenance',$data);
    }

    public function showNotation($id_soutenance){
        $data["soutenance"]=$this->m_prof->getInfoSoutenance($id_soutenance);
        $data["critere"] = $this->m_prof->getCritereFromSoutenance($id_soutenance);

        $this->load->view('v_header');
        $this->load->view('v_prof_notation_navbar',$data);
        $this->load->view('v_prof_notation');
    }

    public function showFusion(){
        $this->load->view('v_header');
        $this->load->view('v_prof_fusion_navbar');
        $this->load->view('v_prof_fusion');
    }

}