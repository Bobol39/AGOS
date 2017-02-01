<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_eleve extends CI_Controller
{

    protected $access = "admin,student";// --> Accesible aux ETUDIANTS
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
		$this->load->model('m_eleve');
    }


    function index(){
        $data = $this->m_eleve->getAllSoutenanceForCurrentEleve();

        $this->load->view("v_header");
        $this->load->view("v_eleve_navbar");
        foreach ($data as $sout){
            if (($sout["titre"] == "")||($sout["resume"] == "")){
                $this->load->view("v_eleve_index", $sout);
                $this->load->view("v_eleve_index", $sout);
                return;
            }
        }
        $notes["notes"] = $this->m_eleve->getAllNotes();
        //var_dump($notes["notes"]); die();
        $this->load->view("v_eleve_notes", $notes);

    }


    function saveResume(){
        $data["titre"] = $this->input->post('titre');
        $data["resume"] = str_replace(array("<script>", "</script>"), array("&ltscript&gt", "&lt/script&gt"), $this->input->post('resume'));
        $id = $this->m_eleve->getAllSoutenanceForCurrentEleve()[0]["id"];
        echo $this->m_eleve->saveResume($data, $id);
    }

    function getInfoSoutHTML(){
        $info = $this->m_eleve->getInfoSout($this->input->post('id'));
        $note=0;
        foreach ($info as $c){
            $note+=$c['note'];
        }

        echo '<div class="row">
                <h3>Note globale</h3><br>
                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
                    <div class="c100 p'.intval(($note*5)).'">
                        <span>'.$note.'/20</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Note détaillée</h3><br>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="block_note_detaillee">';

        foreach ($info as $c){
            echo '<div class="block_moyCrit">
                        <div class="col-lg-10"><span>'.$c['titre_critere'].'</span></div>
                        <div class="col-lg-2">
                            <div class="c100 p'.intval(($c['note']*(100/$c['bareme']))).' small">
                                <span>'.$c['note'].'/'.$c['bareme'].'</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }

        echo '</div></div>';
    }

}
