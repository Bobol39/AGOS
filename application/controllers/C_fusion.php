<?php

/**
 * Created by PhpStorm.
 * User: pelomedusa
 * Date: 08/10/2016
 * Time: 19:04
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class C_fusion extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper(array('form', 'url', 'text', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
//		$this->load->model('Users_model');
    }

    public function index(){
        $this->load->view('v_header');
        $this->load->view('v_navbar_fusion');
        $this->load->view('v_fusion');
    }

}