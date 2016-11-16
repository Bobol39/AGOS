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

    <?php echo "var salles = ".$js_array.";\n"?>
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
                <button class="btn btn-info" id="addline">+creneau</button>
            </div>
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-info" id="addcolumn">+salle</button>
            </div>
            <div  class="col-lg-12 col-md-12 container_controls">
                <button class="btn btn-info" id="removeday">-jour</button>
            </div>
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
                <input type="text" value="" placeholder="Input" class="form-control" />
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

