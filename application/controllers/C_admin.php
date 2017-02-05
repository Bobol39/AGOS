<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller
{
    protected $access = "admin";// --> Accesible aux ADMIN

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

    function editionNotes(){
        $data["groupes"] = $this->m_admin->getAllGroupSoutenance();

        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_edition_notes",$data);
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

    function getSoutenancesToEdit(){
        $id = $this->input->post('id');
        $result = $this->m_admin->getSoutenancesByPlanning($id);
        foreach ($result as $r){
            $r->notes = $this->m_admin->getInfoSout($r->id);
        }
        echo json_encode($result);
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

    function editionChoixGroupe(){
        $this->load->view("v_header");
        $this->load->view("v_admin_navbar");
        $this->load->view("v_admin_leftbar");
        $this->load->view("v_admin_edition_choixgroupe");
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

    public function saveNote(){
        $data["id_soutenance"] = $this->input->post("idsout");
        $affected_rows = 0;
        foreach ($this->input->post("crits") as $c){
            $data["note"] = $c["note"];
            $data["id_critere"] = $c["id"];
            $affected_rows += $this->m_admin->editNote($data);
        }
        if ($affected_rows == 0) echo "false";
        else echo "true";
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

        $newid = $this->m_admin->saveGroupSoutenance($duree,$titre,$promo,$critere);

        if ($id != 0){
            $this->m_admin->deleteGroupSoutenance($id, false);
            $this->m_admin->updateSoutenancesPlanning($id,$newid);
        }
    }

    function deleteGroupSoutenance(){
        $id = $this->input->post('id');
        $this->m_admin->deleteGroupSoutenance($id, true);
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

    function generatePDF(){

        $id= $this->uri->segment(3);
        $data = $this->m_admin->getSoutenancesByPlanningForPDF($id);



        $date = array();
        $prof = array();
        foreach ($data as $soutenance){
            if (!in_array($soutenance->date, $date)){
                array_push($date,$soutenance->date);
            }
            if (!in_array($soutenance->prof1,$prof)){
                $prof[$soutenance->prof1] = array();
                array_push($prof[$soutenance->prof1],$soutenance->prof1);
                array_push($prof[$soutenance->prof1],$soutenance->prof1_nom);
                array_push($prof[$soutenance->prof1],$soutenance->prof1_prenom);
            }
            if (!in_array($soutenance->prof2,$prof)){
                $prof[$soutenance->prof2] = array();
                array_push($prof[$soutenance->prof2],$soutenance->prof2);
                array_push($prof[$soutenance->prof2],$soutenance->prof2_nom);
                array_push($prof[$soutenance->prof2],$soutenance->prof2_prenom);
            }
        }
        asort($prof);


        $horaire = array();
        foreach ($data as $soutenance){
            if (!in_array($soutenance->horaire, $horaire)){
                array_push($horaire,$soutenance->horaire);
            }
        }

        $salle_horaire = array();
        for($i = 0 ; $i<count($horaire); $i++ ){
            $salle_horaire[$horaire[$i]] = array();
            foreach ($data as $soutenance){
                if ($soutenance->horaire == $horaire[$i]){
                    if (!in_array($soutenance->id_salle,$salle_horaire[$horaire[$i]])){
                        array_push($salle_horaire[$horaire[$i]],$soutenance->id_salle);
                    }
                }
            }
            asort($salle_horaire[$horaire[$i]]);
        }

        $all_data["data"] = $data;
        $all_data["date"] = $date;
        $all_data["horaire"] = $horaire;
        $all_data["salle_horaire"] = $salle_horaire;
        $all_data["prof"] = $prof;

        $this->load->view("v_admin_generatePDF",$all_data);

    }
}
?>
