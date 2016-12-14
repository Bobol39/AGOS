<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model
{

    public function checkSave($id){ //return true si l'id n'est pas save dans la base
        $this->db->select("etudiant.id,professeur.id");
        $this->db->from("etudiant,professeur");
        $this->db->where("etudiant.id",$id);
        $this->db->where("professeur.id",$id);

        $query = $this->db->get();

        $row = $query->result_array();
        if($row == null){
            return true;
        }

        return false;
    }

    public function saveUser(){
        $role = $this->session->role;
        $nom = $this->session->nom;
        $prenom = $this->session->prenom;
        $id = $this->session->uid;

        if ($role == "teacher"){
            $data = array(
                'id' => $id ,
                'nom' => $nom,
                'prenom' => $prenom
            );
            $this->db->insert('professeur',$data);
        }else if ($role == "student"){
            $data = array(
                'id' => $id ,
                'nom' => $nom,
                'prenom' => $prenom
            );
            $this->db->insert('etudiant',$data);
        }
    }

}