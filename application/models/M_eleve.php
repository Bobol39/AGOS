<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_eleve extends CI_Model
{
    public function saveResume($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->where('id_etudiant', $this->session->uid);
        $this->db->update('soutenance', $data);
        return $this->db->affected_rows();
    }

    public function insertEtudiant($fname,$lname,$uid,$idPromo){

        $data = array(//set params of new record
            'id' => $uid,
            'prenom' => $fname,
            'nom' => $lname,
            'id_promotion' => $idPromo,
        );
        $this->db->insert('etudiant',$data);

        $insert_id = $this->db->insert_id();
        return $insert_id;//return the id of new record
    }

    public function updateEtudiant($fname,$lname,$uid,$idPromo){
        $data = array(

            'id' => $uid,
            'nom' => $lname,
            'prenom' => $fname,
            'id_promotion' => $idPromo
        );
        $this->db->where('id',$uid);
        $this->db->update('etudiant',$data);
        return $this->db->affected_rows();
    }



    public function checkSave($id){ //return true si l'id n'est pas save dans la base
        $this->db->select("etudiant.id");
        $this->db->from("etudiant");
        $this->db->where("etudiant.id",$id);
        $query = $this->db->get();

        $row = $query->result_array();
        if($row == null){
            return false;
        }

        return true;
    }

    public function getAllSoutenanceForCurrentEleve(){
        $this->db->select('*');
        $this->db->from('soutenance');
        $this->db->where('soutenance.id_etudiant',$this->session->uid);
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
    public function getAllNotes(){
        $this->db->select('id_soutenance,soutenance.titre,note_critere_soutenance.id_critere,critere.titre as titre_critere,note,bareme');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance = soutenance.id');
        $this->db->join('planning','soutenance.id_planning = planning.id');
        $this->db->join('critere_groupe_notation_jonction','planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation');
        $this->db->join('critere','note_critere_soutenance.id_critere = critere.id');
        $this->db->where('soutenance.id_etudiant',$this->session->uid);
        $this->db->where('critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere');
        $query = $this->db->get();
        $row = $query->result_array();
        //die($this->db->last_query());
        return $row;
    }

    public function getInfoSout($idsout){
        $this->db->select('id_soutenance,soutenance.titre,note_critere_soutenance.id_critere,critere.titre as titre_critere,note,bareme');
        $this->db->from('note_critere_soutenance');
        $this->db->join('soutenance','id_soutenance = soutenance.id');
        $this->db->join('planning','soutenance.id_planning = planning.id');
        $this->db->join('critere_groupe_notation_jonction','planning.id_groupe_notation = critere_groupe_notation_jonction.id_groupe_notation');
        $this->db->join('critere','note_critere_soutenance.id_critere = critere.id');
        $this->db->where('soutenance.id_etudiant',$this->session->uid);
        $this->db->where('critere_groupe_notation_jonction.id_critere = note_critere_soutenance.id_critere');
        $this->db->where('soutenance.id = '.$idsout);
        $query = $this->db->get();
        $row = $query->result_array();
        //die($this->db->last_query());
        return $row;
    }
}