<?php

/**
 * Created by PhpStorm.
 * User: Yeso
 * Date: 23/10/2016
 * Time: 19:42
 */
class C_cas extends MY_LoginControl
{
    protected $access = "admin,teacher";// --> Accesible aux ADMIN ET PROF

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
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        //Filtre LP SIL (19 personnes)
        //$filter = "(&(ufclibellesecteurdisciplinaire=Informatique)(ufclibellecomposanteins=IUT de Belfort-Montbéliard)(ufclibellediplome=Lp systèmes informatiques et logiciels)(ufcanneeinscription=2016))";

        $base = "(&(ufclibellecomposanteins=IUT de Belfort-Montbéliard)(ufcanneeinscription=2016)";
        $dut1 = "(ufclibelleetape=DUT Informatique 1e année)";
        $dut2 = "(ufclibelleetape=DUT Informatique 2e année)";
        $lp = "(ufclibelleetape=Lp conception d'applications multi-tiers 3ème année IUT90)";
        $end = ")";
        $filter = $base.$lp.$end;
        //Filtre DUT INNFORMATIQUE 2e ANNEE
        $filterDut2 = "(&(ufclibellecomposanteins=IUT de Belfort-Montbéliard)(ufclibelleetape=DUT Informatique 2e année)(ufcanneeinscription=2016))";
        $data = $this->get_ldap_results($filter);
        $data['students'] = $this->get_ldap_results($filter);;

        $this->load->view("v_cas");
        $this->load->view("v_ldap",$data);
    }

}
