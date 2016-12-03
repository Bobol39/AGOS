<?php

/**
 * Created by PhpStorm.
 * User: Yeso
 * Date: 23/10/2016
 * Time: 19:42
 */
class C_cas extends MY_LoginControl
{
    protected $access = "Admin,teacher";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'text', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
//		$this->load->model('Users_model');
    }

    function index(){
        //$this->cas->force_auth();
        //$this->cas->user();
        $this->load->view("v_header");
        $this->load->view("v_navbar_admin");
        $this->load->view("v_leftbar_admin");
        $this->load->view("v_cas");
    }

}
