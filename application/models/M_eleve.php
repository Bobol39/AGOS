<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_eleve extends CI_Model
{
    public function saveResume($data, $id_etudiant)
    {
        $this->db->where('id_etudiant', $id_etudiant);
        $this->db->update('soutenance', $data);
    }
}