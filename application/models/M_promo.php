<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Promo extends CI_Model
{

    public function insertPromo($namePromo, $nameLdap){

        $data = array(//set params of new record
            'nom' => $namePromo,
//            'name_ldap' => $nameLdap
        );
        $this->db->insert('promotion',$data);

        $insert_id = $this->db->insert_id();
        return $insert_id;//return the id of new record
    }

    public function getAllPromo(){
        $this->db->select('*');
        $this->db->from('promotion');
        $query = $this->db->get();

        $row = $query->result_array();
        return $row;
    }

}