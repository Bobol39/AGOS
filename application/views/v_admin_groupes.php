<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 17/10/2016
 * Time: 16:23
 */
?>

<link href="<?php echo base_url();?>assets/css/groupes.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/datepicker.css" rel="stylesheet">

<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_groupes">
        <div class="col-lg-11 col-md-11" id="container_affichage_groupes">
            <div class="container_groupe col-lg-3 col-md-3">
                <button id="button_add_groupe">+</button>
            </div>
        </div>
        <div class="col-lg-1 col-md-1" id="container_controls_groupes">

        </div>
        <div class="col-lg-11 col-md-11" id="container_modif_groupes">
            <div class="col-lg-6 part_modif">
                <label for="titregroupe" class="labform">Titre:</label>
                <input type="text" name="titregroupe" id="titregroupe" value="" placeholder="Titre du groupe" class="form-control" />

                <label for="selectpromo" class="labform">Promo:</label>
                <select id="selectpromo">
                    <option value="default">-- Choisissez une promotion --</option>
                    <option value="s1">S1</option>
                    <option value="s2">S2</option>>
                    <option value="s3">S3</option>
                    <option value="s4">S4</option>
                    <option value="lp">LP</option>
                </select>

                <label for="selectcriteres" class="labform">Critères:</label>
                <select name="selectcriteres" id="selectcriteres">
                    <option value="default">-- Choisissez des critères --</option>
                    <option value="pt">Projets Tutorés</option>
                    <option value="stage">Stage</option>
                </select>

                <label for="duree" class="labform">Durée:</label>
                <input id="duree" name="duree" type="number" value="20"><p>mn</p>

            </div>
            <div class="col-lg-6 part_modif">
                <label for="datepicker" class="labform">Jours:</label>
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
                <input type="text" name="datepicker" class="datepicker">
                <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                    <a href="<?php echo base_url("index.php/C_admin/showPlanning")?>">
                        <button class="btn btn-info" id="edit_planning">Planning</button>
                    </a>
                    <button class="btn btn-danger" id="delete_group">Supprimer</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/groupes.js"> </script>

