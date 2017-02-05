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
                'abreviation' => $value["abrev"],
                'admin' => $value["admin"]
            );
            array_push($final,$temp);
        }

        $this->db->update_batch('professeur', $final, 'id');
    }

    public function editNote($data){
        $this->db->where('id_soutenance',$data["id_soutenance"]);
        $this->db->where('id_critere',$data["id_critere"]);
        $this->db->update('note_critere_soutenance',$data);
        return $this->db->affected_rows();
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
        return $this->db->insert_id();
    }

    function updateSoutenancesPlanning($oldId, $newId){
        $data = array(
            'id_planning' => $newId
        );

        $this->db->where('id_planning', $oldId);
        $this->db->update('soutenance', $data);
    }

    public function deleteGroupSoutenance($id, $deleteSoutenancesToo){
        $this->db->where('id',$id);
        $this->db->delete('planning');

        if ($deleteSoutenancesToo){
            $this->deleteSoutenances($id);
        }
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
        $sout = $this->getSoutenancesByPlanning($idplanning);
        $this->db->delete('soutenance', array('id_planning' => $idplanning));

        foreach ($sout as $s){
            $this->db->delete('interface_prof_soutenance', array('id_soutenance' => $s->id));
            $this->db->delete('note_critere_soutenance', array('id_soutenance' => $s->id));
        }
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
        $this->db->order_by("date", "asc");

        $query = $this->db->get();
        return $query->result();
    }

    public function getSoutenancesByPlanningForPDF($idgroup){
        $this->db->select('id_salle,date,id_etudiant,p1.abreviation as prof1,p1.nom as prof1_nom,p1.prenom as prof1_prenom,p2.abreviation as prof2,p2.nom as prof2_nom,p2.prenom as prof2_prenom,DATE_FORMAT(horaire, "%k:%i") as horaire');
        $this->db->from('soutenance');
        $this->db->join('professeur p1','soutenance.professeur1 = p1.id ','left');
        $this->db->join('professeur p2','soutenance.professeur2 = p2.id ','left');
        $this->db->where('id_planning',$idgroup);
        $this->db->order_by("date", "asc");
        $this->db->order_by("horaire", "desc");

        $query = $this->db->get();
        return $query->result();
    }

    public function getInfoSout($idsout){
        $this->db->select('critere.id,critere.titre as titre_critere,note,bareme');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance = soutenance.id');
        $this->db->join('planning','soutenance.id_planning = planning.id');
        $this->db->join('critere_groupe_notation_jonction','planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation');
        $this->db->join('critere','note_critere_soutenance.id_critere = critere.id');
        $this->db->where('critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere');
        $this->db->where('soutenance.id = '.$idsout);
        $query = $this->db->get();
        $row = $query->result_array();
        //die($this->db->last_query());
        return $row;
    }
}