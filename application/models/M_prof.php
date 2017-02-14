<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prof extends CI_Model
{
    public function getInfoSoutenance($id){ //id soutenance
        $this->db->select('soutenance.*,planning.duree,planning.delai_alerte');
        $this->db->from('soutenance');
        $this->db->join('planning','planning.id=soutenance.id_planning');
        $this->db->where('soutenance.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCritereFromSoutenance($id){ //id soutenance
        $this->db->select('critere.titre , critere_groupe_notation_jonction.bareme, critere.id');
        $this->db->from('critere');
        $this->db->join('critere_groupe_notation_jonction','critere.id=critere_groupe_notation_jonction.id_critere');
        $this->db->join('planning','critere_groupe_notation_jonction.id_groupe_notation=planning.id_groupe_notation');
        $this->db->join('soutenance','planning.id=soutenance.id_planning');
        $this->db->where('soutenance.id',$id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function getSoutenancesByTutor($id_tutor){
        $this->db->select('soutenance.*, planning.duree');
        $this->db->from('soutenance');
        $this->db->join('planning', 'soutenance.id_planning = planning.id');
        $this->db->where('soutenance.professeur1',$id_tutor);
        $this->db->where('soutenance.date', date('Y-m-d'));
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getSoutenancesByAssistant($id_tutor){
        $this->db->select('soutenance.*, planning.duree');
        $this->db->from('soutenance');
        $this->db->join('planning', 'soutenance.id_planning = planning.id');
        $this->db->where('soutenance.professeur2',$id_tutor);
        $this->db->where('soutenance.date', date('Y-m-d'));
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function saveCommentaire($id_soutenance,$id_prof,$text,$img_name){
        $data = array(
            'id_soutenance' => $id_soutenance,
            'id_professeur' => $id_prof,
            'text_note' => $text,
            'img_note' => $img_name
        );
        $this->db->insert('interface_prof_soutenance',$data);
    }

    public function saveNote($data){
        $final = array();
        $i = 0;
        foreach ($data["critere"] as $value){
            $temp = array(
                'id_soutenance' => $data["id_soutenance"],
                'id_critere' => $value->id,
                'note' => $data["note"][$i]
            );
            array_push($final,$temp);
            $i++;
        }
        $this->db->insert_batch('note_critere_soutenance', $final);
    }

    public function checkNote($id_soutenance){
        $this->db->select('id_soutenance');
        $this->db->from('note_critere_soutenance');
        $this->db->where('id_soutenance',$id_soutenance);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    function getAllGroupSoutenanceWhereProfInvolved($idprof){
        $this->db->distinct();
        $this->db->select('planning.*');
        $this->db->from('planning');
        $this->db->join('soutenance','soutenance.id_planning = planning.id');
        $this->db->where("soutenance.professeur1",$idprof);
        $this->db->or_where("soutenance.professeur2 = '".$idprof."'");
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    function isAdmin($id){
        $this->db->select('admin');
        $this->db->from('professeur');
        $this->db->where("id", $id);
        $query = $this->db->get();
        return ($query->row()->admin == "1");
    }

    public function getAllGroupSoutenance(){
        $this->db->select('*');
        $this->db->from('planning');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function getSoutenancesByPlanning($idgroup){
        $this->db->select('soutenance.*,DATE_FORMAT(horaire, "%k:%i") as horaire, DATE_FORMAT(date,"%d-%m-%Y") AS date,p1.abreviation as prof1,p2.abreviation as prof2');
        $this->db->from('soutenance');
        $this->db->join('professeur p1','soutenance.professeur1 = p1.id ','left');
        $this->db->join('professeur p2','soutenance.professeur2 = p2.id ','left');
        $this->db->where('id_planning',$idgroup);
        $this->db->order_by("horaire", "desc");

        $query = $this->db->get();
        return $query->result();
    }

    public function getSoutenancesByPlanningAndProf($idgroup, $idprof){
        $this->db->select('*,DATE_FORMAT(horaire, "%k:%i") as horaire, DATE_FORMAT(date,"%d-%m-%Y") AS date');
        $this->db->from('soutenance');
        $this->db->where('id_planning',$idgroup);
        $this->db->where('professeur1',$idprof);
        $this->db->or_where('professeur2',$idprof);
        $this->db->order_by("horaire", "desc");

        $query = $this->db->get();
        return $query->result();
    }

    public function getInfoSout($idsout){
        $this->db->select('critere.id,critere.titre as titre_critere,note,bareme');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance = soutenance.id');
        $this->db->join('planning','soutenance.id_planning = planning.id');
        $this->db->join('critere_groupe_notation_jonction','planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation');
        $this->db->join('critere','note_critere_soutenance.id_critere = critere.id');
        $this->db->where('critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere');
        $this->db->where('soutenance.id = '.$idsout);
        $query = $this->db->get();
        $row = $query->result_array();
        //die($this->db->last_query());
        return $row;
    }

    public function editNote($data){
        $this->db->where('id_soutenance',$data["id_soutenance"]);
        $this->db->where('id_critere',$data["id_critere"]);

        $this->db->update('note_critere_soutenance',$data);
        return $this->db->affected_rows();
    }
}