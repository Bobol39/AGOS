<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model
{


    public function getAllProf(){
        $this->db->select('*');
        $this->db->from('professeur');
        $query = $this->db->get();

        $row = $query->result_array();
        return $row;
    }

    public function saveAbreviation($data){

        $final = array();
        foreach ($data as $value){
            $temp = array(
                'id' => array_search($value,$data),
                'abreviation' => $value
            );
            array_push($final,$temp);
        }


        $this->db->update_batch('professeur', $final, 'id');
    }
}