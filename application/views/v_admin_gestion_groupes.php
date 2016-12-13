<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 17/10/2016
 * Time: 16:23
 */
?>


<link href="<?php echo base_url();?>assets/css/gestion_groupes.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/datepicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">


<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_groupes">
        <div class="col-lg-11 col-md-11" id="container_affichage_groupes">
            <?php foreach($groupe_soutenance as $group){?>
                <div class="container_groupe col-lg-3 col-md-3">
                    <button class="btn btn-success btn-fill button_groupe"><?= $group['titre'] ?></button>
                    <input type="hidden" class="group_promo" value="<?= $group['id_promotion'] ?>">
                    <input type="hidden" class="group_criteres" value="<?= $group['id_groupe_notation'] ?>">
                    <input type="hidden" class="group_duree" value="<?= $group['duree'] ?>">
                    <input type="hidden" class="group_id" value="<?= $group['id'] ?>">
                </div>
            <?php } ?>
            <div class="container_groupe col-lg-3 col-md-3">
                <button id="button_add_groupe">+</button>
            </div>
        </div>
        <div class="col-lg-11 col-md-11" id="container_modif_groupes">
            <div class="col-lg-6 part_modif">
                <label for="titregroupe" class="labform">Titre:</label>
                <input type="text" name="titregroupe" id="titregroupe" value="" placeholder="Titre du groupe" class="form-control" />

                <label for="selectpromo" class="labform">Promo:</label>
                <select id="selectpromo">
                    <option value="default">-- Choisissez une promotion --</option>
                    <?php foreach($promotion as $value){?>
                        <option value="<?= $value['id'] ?>"><?= $value['nom'] ?></option>
                    <?php }?>
                </select>

                <label for="selectcriteres" class="labform">Critères:</label>
                <select name="selectcriteres" id="selectcriteres">
                    <option value="default">-- Choisissez des critères --</option>
                    <?php foreach($groupe_critere as $value){?>
                        <option value="<?= $value['id'] ?>"><?= $value['titre'] ?></option>
                    <?php }?>
                </select>

                <label for="duree" class="labform">Durée:</label>
                <input id="duree" name="duree" type="number" value="20"><p>mn</p>
                <input type="hidden" id="idgroup">
            </div>
            <div class="col-lg-6 part_modif">
                <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 text-center">
                    <button class="btn btn-info" id="edit_planning">Planning</button>
                    <button class="btn btn-danger" id="delete_group">Supprimer</button><br>
                    <button class="btn btn-success" id="valid_group">Valider</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin_gestion_groupes.js"> </script>

