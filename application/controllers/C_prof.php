<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_prof extends CI_Controller
{

    protected $access = "admin,teacher";// --> Accesible aux ADMIN ET PROF

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
        $login = $this->session->uid;
        $data["soutenances_tuteur"] = $this->m_prof->getSoutenancesByTutor($login);

        $i = 0;
        foreach ($data["soutenances_tuteur"] as $sout_tut){
            $temp = $this->m_prof->checkNote($sout_tut["id"]);
            if ($temp != null ){
                unset($data["soutenances_tuteur"][$i]);
            }
            $i++;
        }

        $data["soutenances_temoin"] = $this->m_prof->getSoutenancesByAssistant($login);
        $i = 0;
        foreach ($data["soutenances_temoin"] as $sout_te){
            $temp = $this->m_prof->checkNote($sout_te["id"]);
            if ($temp != null ){
                unset($data["soutenances_temoin"][$i]);
            }
            $i++;
        }

        $data["login"] = $login;

        $this->load->view('v_header');
        $this->load->view('v_prof_navbar');
        $this->load->view('v_prof_choix_soutenance',$data);
    }

    public function showNotation($id_soutenance){

        $data["soutenance"]=$this->m_prof->getInfoSoutenance($id_soutenance);
        $data["critere"] = $this->m_prof->getCritereFromSoutenance($id_soutenance);
        $data["soutenance"]->nbrCritere = count($data["critere"]);
        $data["login"] = $this->session->uid;
        $data["tuteur"] = ($data["soutenance"]->professeur1 == $this->session->uid) ? 1 : 0;
        $this->load->view('v_header');

        $this->load->view('v_prof_notation_navbar',$data);
        $this->load->view('v_prof_notation_ajuster');
        $this->load->view('v_prof_notation');
    }

    public function showFusion($id_soutenance){
        $data["soutenance"]=$this->m_prof->getInfoSoutenance($id_soutenance);
        $data["critere"] = $this->m_prof->getCritereFromSoutenance($id_soutenance);
        $data["soutenance"]->nbrCritere = count($data["critere"]);
        $data["login"] = $this->session->uid;;
        $data["tuteur"] = ($data["soutenance"]->professeur1 == $this->session->uid) ? 1 : 0;



        $this->load->view('v_header');
        $this->load->view('v_prof_fusion_navbar',$data);
        $this->load->view('v_prof_fusion');
    }

    public function saveCommentaire(){
        $data["id_soutenance"]= $this->input->post('id_soutenance');
        $data["login_prof"]= $this->input->post('login');
        $data["text"]= $this->input->post('text');
        $img= $this->input->post('img');

        //définir le chemin du dossier AGOS en fonction de sa propre installation
        define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT'].'/AGOS/assets/img/img_canvas/');

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data_img = base64_decode($img);
        $name = $data["id_soutenance"].$data["login_prof"];
        $file = UPLOAD_DIR .$name.'.png';
        $success = file_put_contents($file, $data_img);
        print $success ? $file : 'Unable to save the file.';


        $this->m_prof->saveCommentaire($data["id_soutenance"],$data["login_prof"],$data["text"],$name);
    }

    public function saveNote(){
        $data["id_soutenance"] = $this->input->post("id_soutenance");
        $data["note"] = json_decode($this->input->post("note"));
        $data["critere"] = json_decode($this->input->post("critere"));
        $this->m_prof->saveNote($data);
    }


    function editionNotes(){
        if ($this->m_prof->isAdmin($this->session->uid) == 1){
            $data["groupes"] = $this->m_prof->getAllGroupSoutenance();
        } else {
            $data["groupes"] = $this->m_prof->getAllGroupSoutenanceWhereProfInvolved($this->session->uid);
        }

        $this->load->view("v_header");
        $this->load->view("v_prof_navbar");
        $this->load->view("v_prof_edition_notes",$data);
    }

    function getSoutenancesToEdit(){
        $id = $this->input->post('id');

        if ($this->m_prof->isAdmin($this->session->uid) == 1){
            $result = $this->m_prof->getSoutenancesByPlanning($id);
        } else {
            $result = $this->m_prof->getSoutenancesByPlanningAndProf($id, $this->session->uid);
        }

        foreach ($result as $r){
            $r->notes = $this->m_prof->getInfoSout($r->id);
        }
        echo json_encode($result);
    }


    public function editNote(){
        $data["id_soutenance"] = $this->input->post("idsout");
        $affected_rows = 0;
        foreach ($this->input->post("crits") as $c){
            $data["note"] = $c["note"];
            $data["id_critere"] = $c["id"];
            $affected_rows += $this->m_prof->editNote($data);
        }
        if ($affected_rows == 0) echo "false";
        else echo "true";
    }

}
