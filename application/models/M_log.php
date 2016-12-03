<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model
{

    public function checkSave($id){
        $this->db->select("id");
        $this->db->from("etudiant,professeur");
        $this->db->where("id",$id);

        $query = $this->db->get();

        $row = $query->result_array();
        if($row == null){
            return true;
        }

        return false;
    }

}