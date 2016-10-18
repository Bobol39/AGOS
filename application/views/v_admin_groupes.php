<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 17/10/2016
 * Time: 16:23
 */
?>

<link href="<?php echo base_url();?>assets/css/groupes.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">

<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_groupes">
        <div class="col-lg-11 col-md-11" id="container_affichage_groupes">
            <div class="container_groupe col-lg-3 col-md-3">
                <button class="btn btn-success btn-fill button_groupe">Group1</button>
            </div>
            <div class="container_groupe col-lg-3 col-md-3">
                <button class="btn btn-success btn-fill button_groupe">Group2</button>
            </div>
            <div class="container_groupe col-lg-3 col-md-3">
                <button class="btn btn-success btn-fill button_groupe">Group3</button>
            </div>
            <div class="container_groupe col-lg-3 col-md-3">
                <button class="btn btn-success" id="button_add_groupe">Ajouter</button>
            </div>
        </div>
        <div class="col-lg-1 col-md-1" id="container_controls_groupes">

        </div>
        <div class="col-lg-11 col-md-11" id="container_modif_groupes">
            <div class="col-lg-6">
                <label for="titregroupe">Titre:</label>
                <input type="text" name="titregroupe" id="titregroupe" value="" placeholder="Titre du groupe" class="form-control" />

                <label for="datepcker">Jours:</label>
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
            </div>
            <div class="col-lg-6">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/groupes.js"> </script>

