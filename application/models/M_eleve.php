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

    //SELECT `id_soutenance`, `id_critere`, `note`
    // FROM `note_critere_soutenance`
    // JOIN `soutenance` ON `id_soutenance`= `soutenance`.`id` WHERE `soutenance`.`id_etudiant` = "ajossic"
    public function getALlNotes($id_etudiant){
        $this->db->select('id_soutenance,id_critere,note');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance= soutenance.id');
        $this->db->where('soutenance.id_etudiant',$id_etudiant);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
}