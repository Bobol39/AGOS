<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginControl extends CI_Controller {

    /**
     * 'Admin' for admin
     * 'Teacher' for editor group
     * 'Student' for author group
     * @var string
     */
    protected $access = "@";

    public function __construct()
    {
        parent::__construct();
        $this->login_check();
    }

    public function login_check()
    {
        //Getting user info if logged in
        $this->session->user = $this->cas->user();


        // check does he/she has logged in
        // if not, redirect to CAS login page
        if (!isset($this->session->user)) {
            $this->load->library('cas');
            $this->cas->force_auth();
        }

        else{
            //we user is logged in check if he has permission to access this page
            // here we check the role of the user
            //AT this point user is logged in
            if (! $this->permission_check()) {
                die("<h4>Access denied</h4>");
            }
        }
    }

    //check if user's access is in the allowed userlist of this page
    public function permission_check()
    {
        if ($this->access == "@") {
            return true;
        }
        else
        {
            $access = is_array($this->access) ?
                $this->access : explode(",", $this->access);
            //check if user's access is in the allowed userlist of this page
            if (in_array($this->session->user("role"), array_map("trim", $access)) ) {
                return true;
            }

            return false;
        }
    }

}