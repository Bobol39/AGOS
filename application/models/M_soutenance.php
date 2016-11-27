<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_soutenance extends CI_Model
{
    public function getInfoSoutenance($id){ //id soutenance
        $this->db->select('*');
        $this->db->from('soutenance');
        $this->db->where('soutenance.id',$id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
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
}