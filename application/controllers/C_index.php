<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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
//		$this->load->model('Users_model');
	}


	public function index()
	{
		$this->load->view('v_header');
		$this->load->view('v_login');
	}

	public function form_valid_connexion(){
		$login = $this->input->post('login');
		if ($login == "prof") {
			Redirect("c_notation");
		}else if ($login == "admin") {
			Redirect("c_admin");
		}else if($login =="eleve"){
			Redirect("c_eleve");
		}
//		$this->form_validation->set_rules('login','login','trim|required');
//		$this->form_validation->set_rules('pass','Mot de passe','trim|required');
//		$donnees= array(
//			'login'=>$this->input->post('login'),
//			'pass'=>$this->input->post('pass')
//		);
//		if($this->form_validation->run() == False){
//			$this->load->view('connexion',$donnees);
//		}
//		else {
//			$donnees_session=array();
//			if(($donnees_session=$this->Users_model->verif_connexion($donnees)) != False)// and valide ==1
//			{
//				$this->session->set_userdata($donnees_session);
//				if ($donnees_session['droit'] == 0) {
//					redirect('Users');
//				}else{
//					redirect('Admin');
//				}
//			}
//			else{
//				$donnees['erreur']="mot de passe ou login incorrect";
//				redirect('Welcome');
//
//			}
//		}
	}

}
