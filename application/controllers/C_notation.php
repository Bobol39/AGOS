<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_notation extends CI_Controller
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
		$this->load->model('m_soutenance');
    }

    public function index(){
        $id_soutenance = 3;
        $data["soutenance"]=$this->m_soutenance->getInfoSoutenance($id_soutenance);
        $data["critere"] = $this->m_soutenance->getCritereFromSoutenance($id_soutenance);

        $this->load->view('v_header');
        $this->load->view('v_navbar_notation',$data);
        $this->load->view('v_notation');
    }

}
