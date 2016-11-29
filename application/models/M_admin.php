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

    public function getSalle(){
        $this->db->select('*');
        $this->db->from('salle');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function supprSalle($id){
        $this->db->where("id",$id);
        $this->db->delete('salle');
    }

    public function createSalle($nom){
        $data = array(
            'nom' => $nom
        );
        $this->db->insert('salle', $data);
    }

    public function getPromotions(){
        $this->db->select('*');
        $this->db->from('promotion');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function saveCritere($titre){
        $data = array(
            'titre' => $titre
        );
        $this->db->insert('critere',$data);
    }

    public function getAllCritere(){
        $this->db->select('*');
        $this->db->from('critere');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function createGroupCritere($val){
        $data = array(
            'titre' => $val["titre"]
        );
        $this->db->insert('groupe_notation', $data);
        $id = $this->db->insert_id();

        $data2 = array();
        foreach($val["array"] as $value){
            $temp = array(
                'id_critere' => $value[0] ,
                'id_groupe_notation' => $id,
                'bareme' => $value[1]
            );
            array_push($data2,$temp);
        }
        $this->db->insert_batch('critere_groupe_notation_jonction', $data2);
    }

    public function getAllGroupCritere(){
        $this->db->select('*');
        $this->db->from('groupe_notation');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function getCritereFromGroup($id){
        $this->db->select('critere.titre,critere_groupe_notation_jonction.bareme,critere.id');
        $this->db->from('critere_groupe_notation_jonction');
        $this->db->join('critere','critere_groupe_notation_jonction.id_critere = critere.id');
        $this->db->where('id_groupe_notation',$id);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function modifCritereFromGroup($val){
        $this->db->delete('critere_groupe_notation_jonction', array('id_groupe_notation' => $val["id"]));

        $data = array();
        foreach($val["array"] as $value){
            $temp = array(
                'id_critere' => $value[0] ,
                'id_groupe_notation' => $val["id"],
                'bareme' => $value[1]
            );
            array_push($data,$temp);
        }

        $this->db->insert_batch('critere_groupe_notation_jonction', $data);
    }

    public function saveGroupSoutenance($duree,$titre,$promo,$critere,$date){
        $data = array(
            'duree' => $duree,
            'titre' => $titre,
            'id_promotion' => $promo,
            'id_groupe_notation' => $critere
        );
        $this->db->insert('planning',$data);
    }

    public function deleteGroupSoutenance($id){
        $this->db->where('id',$id);
        $this->db->delete('planning');
    }

    public function getAllGroupSoutenance(){
        $this->db->select('*');
        $this->db->from('planning');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function saveSoutenance($data){
        unset($data["eleve"]);
        $this->db->insert('soutenance', $data);
    }

    public function deleteSoutenances($idplanning){
        $this->db->delete('soutenance', array('id_planning' => $idplanning));
    }

    public function getEtudiantsByGroup($idgroup){
        $this->db->select('etudiant.*');
        $this->db->from('etudiant');
        $this->db->join('planning','planning.id_promotion = etudiant.id_promotion');
        $this->db->where('planning.id',$idgroup);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function getSoutenancesByPlanning($idgroup){
        $this->db->select('*,DATE_FORMAT(horaire, "%k:%i") as horaire');
        $this->db->from('soutenance');
        $this->db->where('id_planning',$idgroup);
        $this->db->order_by("horaire", "asc");

        $query = $this->db->get();
        return $query->result();
    }
}