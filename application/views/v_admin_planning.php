<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 14/10/2016
 * Time: 14:22
 */

$js_array = json_encode($salle)
?>

<link href="<?php echo base_url();?>assets/css/planning.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/jquery.timepicker.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap-select.min.css" rel="stylesheet">

<script>
    <?php echo "var salles = ".$js_array.";\n";
    echo "var soutJSON = ".$soutenances.";\n";
    ?>
</script>
<div id="promptday_layer">
    <div id="promptday">
        <div id="promptday_header"><span>Ajouter un jour</span></div>
        <div id="promptday_content">
            <h3>Choisissez une date</h3>
            <input type="text" id="newday_datepicker" name="datepicker"><br>
            <button class="btn btn-success" id="valider_promptday">Ajouter</button>
        </div>
    </div>
</div>
<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_planning">
        <div class="col-lg-11 col-md-11" id="container_soutenances">
            <div id="tabs" style="height: 100%">
                <ul>
                    <li id="ajouterJour"><a href="#tabs-0">Ajouter un jour</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-1 col-md-1" id="container_controls_planning">
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-info" id="addline">
                    <span class="glyphicon glyphicon-plus"></span><br />
                    <span>Creneau</span>
                </button>
            </div>
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-info" id="addcolumn">
                    <span class="glyphicon glyphicon-plus"></span><br />
                    <span>Salle</span>
                </button>
            </div>
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-info" id="removeday">
                    <span class="glyphicon glyphicon-minus"></span><br />
                    <span>Jour</span>
                </button>
            </div>
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-success" id="savePlanning">SAVE</button>
            </div>
            <input id="idgroup" type="hidden" value="<?php echo $idgroup?>">
        </div>
        <div class="col-lg-11 col-md-11" id="container_modif_soutenances">
            <div class="col-lg-3 col-lg-3" id="block_modif_prof1">
                <h3>Professeur 1 (Tuteur)</h3>
                <select class="form-control" >
                    <?php foreach ($prof as $value){ ?>
                        <option value="<?php echo $value["id"]?>"><?php echo $value["nom"]." ".$value["prenom"]?></option>
                    <?php }?>
                </select>
            </div>
            <div id="block_modif_eleve" class="col-lg-6 col-md-6">
                <h4>Chef de Projet</h4>
                <select class="form-control" >
                    <?php foreach ($eleves as $eleve){ ?>
                        <option value="<?php echo $eleve["id"]?>"><?php echo $eleve["nom"]." ".$eleve["prenom"]?></option>
                    <?php }?>
                </select>
                -                <button class="btn btn-danger" id="removeSoutenance">Supprimer cette soutenance</button>
            </div>
            <div class="col-lg-3 col-lg-3" id="block_modif_prof2">
                <h3>Professeur 2</h3>
                <select class="form-control" >
                    <?php foreach ($prof as $value){ ?>
                        <option value="<?php echo $value["id"]?>"><?php echo $value["nom"]." ".$value["prenom"]?></option>
                    <?php }?>
                </select>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/planning.js"> </script>

