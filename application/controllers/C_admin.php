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
        $this->gestionGroupes();
    }

    function gestionProf(){
        $data["prof"] = $this->m_admin->getAllProf();
        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_gestion_prof",$data);
    }

    function showPlanning($idgroup){
        $data["salle"] = $this->m_admin->getSalle();
        $data["prof"] = $this->m_admin->getAllProf();
        $data["idgroup"] = $idgroup;
        $data["eleves"] = $this->m_admin->getEtudiantsByGroup($idgroup);
        $data["soutenances"] = json_encode($this->m_admin->getSoutenancesByPlanning($idgroup));

        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
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
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_gestion_salles",$data);
    }

    function supprSalle(){
        $data["id"] = $this->input->post('id');
        $this->m_admin->supprSalle($data['id']);
    }

    function createSalle(){
        $data["nom"] = $this->input->post('nom');
        $this->m_admin->createSalle($data["nom"]);
    }

    function gestionGroupes(){
        $data["promotion"] = $this->m_admin->getPromotions();
        $data["groupe_critere"] = $this->m_admin->getAllGroupCritere();
        $data["groupe_soutenance"] = $this->m_admin->getAllGroupSoutenance();

        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_gestion_groupes",$data);
    }

    function gestionNotation(){
        $data["critere"]= $this->m_admin->getAllCritere();
        $data["groupe_critere"]= $this->m_admin->getAllGroupCritere();

        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_gestion_notation",$data);
    }

    function saveCritere(){
        $data["titre"]= $this->input->post('titre');
        $this->m_admin->saveCritere($data["titre"]);
    }

    function createGroupCritere(){
        $data["titre"]= $this->input->post('titre');
        $data["array"] = $this->input->post('array');
        $decode = json_decode($data["array"]);
        $data["array"] = json_decode(json_encode($decode), True);

        $this->m_admin->createGroupCritere($data);
    }

    function getCritereFromGroup(){
        $id = $this->input->post('id');
        $crit = $this->m_admin->getCritereFromGroup($id);
        echo json_encode($crit);
    }

    function modifCritereFromGroup(){
        $data["id"]= $this->input->post('id');
        $data["array"] = $this->input->post('array');
        $decode = json_decode($data["array"]);
        $data["array"] = json_decode(json_encode($decode), True);
        $this->m_admin->modifCritereFromGroup($data);
    }

    function saveGroupSoutenance(){
        $duree = $this->input->post('duree');
        $titre = $this->input->post('titre');
        $promo = $this->input->post('promo');
        $critere = $this->input->post('critere');
        $id = $this->input->post('id');

        if ($id != 0){
            $this->m_admin->deleteGroupSoutenance($id);
        }

        $this->m_admin->saveGroupSoutenance($duree,$titre,$promo,$critere);
    }

    function deleteGroupSoutenance(){
        $id = $this->input->post('id');
        $this->m_admin->deleteGroupSoutenance($id);
    }


    function savePlanning(){

        $soutenances = $this->input->post("soutenances");
        $decode = json_decode($soutenances);
        $soutenances = json_decode(json_encode($decode), True);
        $this->m_admin->deleteSoutenances($soutenances[0]['id_planning']);

        foreach ($soutenances as $sout){
            $this->m_admin->saveSoutenance($sout);
        }
    }
}
?>
