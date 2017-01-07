<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_eleve extends CI_Model
{
    public function saveResume($data, $id_etudiant)
    {
        $this->db->where('id_etudiant', $id_etudiant);
        $this->db->update('soutenance', $data);
    }

    public function getAllSoutenance($id_etudiant){
        $this->db->select('*');
        $this->db->from('soutenance');
        $this->db->where('soutenance.id_etudiant',$id_etudiant);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

//SELECT `id_soutenance`, `note_critere_soutenance`.`id_critere`,critere.titre, `note`,`bareme`
//FROM `note_critere_soutenance`
//JOIN `soutenance` ON `id_soutenance`= `soutenance`.`id`
//JOIN `planning` ON soutenance.id_planning = planning.id
//JOIN critere_groupe_notation_jonction ON planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation
//JOIN critere ON `note_critere_soutenance`.`id_critere` = critere.id
//WHERE `soutenance`.`id_etudiant` = "ajossic"
//AND critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere
    public function getAllNotes($id_etudiant){
        $this->db->select('id_soutenance,soutenance.titre,note_critere_soutenance.id_critere,critere.titre as titre_critere,note,bareme');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance = soutenance.id');
        $this->db->join('planning','soutenance.id_planning = planning.id');
        $this->db->join('critere_groupe_notation_jonction','planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation');
        $this->db->join('critere','note_critere_soutenance.id_critere = critere.id');
        $this->db->where('soutenance.id_etudiant',$id_etudiant);
        $this->db->where('critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere');
        $query = $this->db->get();
        $row = $query->result_array();
        //die($this->db->last_query());
        return $row;
    }
}