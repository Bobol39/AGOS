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
        $this->load->model('m_admin');
        $this->load->model('m_promo');
        $this->load->model('m_eleve');



//		$this->load->model('Users_model');
    }

    function index(){
        //$this->cas->force_auth();
        //$this->edddcas->user();
        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_new_promo");
    }

    function update_promo(){
        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $data["promos"] = $this->m_promo->getAllPromo();
        $this->load->view("v_update_promo",$data);
    }

    function get_promo_from_ldap(){
        //recupération des paramètres
        $login = $this->input->post('login');
        $pass = $this->input->post('pass');
        $name_ldap = $this->input->post('nameLdap');
        $year = $this->input->post('year');
        $request = $this->input->post('request');


        //================> FILTRES
        // Lp conception d'applications multi-tiers 3ème année IUT90
        // DUT Informatique 1e année
        // DUT Informatique 2e année

        //Construction du filtre ldap
        $base = "(&(ufclibellecomposanteins=IUT de Belfort-Montbéliard)(ufcanneeinscription=$year)";
        $search = "(ufclibelleetape=".$name_ldap.")";
        $end = ")";
        $finalFilter = $base.$search.$end;

        $result_promo = $this->import_promo_from_ldap($login,$pass,$finalFilter);//importing promo from ldap
        //import_promo_from_ldap: if a problem happened it returns false

        if($result_promo == false)//Si erreur de connexion ldap
        {
            die("connect_error");
        }else if(count($result_promo) == 0){
            die("no_results");
        }
        else{
            $result_promo = $this->clean_result($result_promo);//bon formatage de l'array

            if(@$request == "update"){
                $result_promo = $this->keep_new_only($result_promo);//keep only new records
            }

            $this->session->set_userdata('students',null);//eviter les doublons
            $this->session->set_userdata('students',$result_promo);//ajout des etudiants en accès global à la classe
            if(count($result_promo) == 0)//If nothing stays after removing duplicates
                die("up_to_date");
            else
                echo json_encode($result_promo);
        }
    }

    public function keep_new_only($students){//check in db if user exists, if yes do not keep it
        $i = 0;
        $result = array();

        foreach ($students as $key => $student){
            if (is_array($student) && isset($student["uid"][0])) {
                $exists = $this->m_eleve->checkSave($student["uid"][0]);
                if(!$exists){//keep user if not in database
                    $result[$i] = $student;
                    $i++;
                }
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function clean_result($students)//reformat array of students and remove useless lines (count or empty)
    {
        $i = 0;
        $result = array();
        foreach ($students as $key => $student){
            if (is_array($student) && isset($student["uid"][0])) {
                    $result[$i] = array();
                    $result[$i]["sn"] = $student["sn"][0];
                    $result[$i]["givenname"] = $student["givenname"][0];
                    $result[$i]["uid"] = $student["uid"][0];
                    $i++;
            }
        }
        return $result;
    }


    function create_new_promo(){//AJAX
        $namePromo = $this->input->post('namePromo');
        $nameLdap = $this->input->post('nameLdap');

        if($namePromo == null)//TESTS OF INTEGRITY
            die("false");
        if($namePromo == '')
            die("false");

        $idPromo = $this->m_promo->insertPromo($namePromo, $nameLdap);


        $students = $this->session->students;


        foreach($students as $student){
            $nom = $student["givenname"];
            $prenom = $student["sn"];
            $uid = $student["uid"];

            if($this->m_eleve->checkSave($uid))
                $this->m_eleve->updateEtudiant($prenom,$nom,$uid,$idPromo);

            else
                $this->m_eleve->insertEtudiant($prenom,$nom,$uid,$idPromo);
        }
        echo"true";

    }

    public function update_promo_users(){//AJAX
        //
    }





}
