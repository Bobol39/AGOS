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
        $this->db->select('critere.titre , critere_groupe_notation_jonction.bareme');
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
        $this->db->select('*');
        $this->db->from('soutenance');
        $this->db->where('soutenance.professeur1',$id_tutor);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function getSoutenancesByAssistant($id_tutor){
        $this->db->select('*');
        $this->db->from('soutenance');
        $this->db->where('soutenance.professeur2',$id_tutor);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
}