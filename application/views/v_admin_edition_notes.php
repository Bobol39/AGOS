<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 28/01/2017
 * Time: 11:16
 */
?>

<link href="<?php echo base_url();?>assets/css/edition_notes.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">



<div id="container_admin" class="col-lg-10 col-md-10">
    <div id="container_select" class="col-lg-12 col-md-12 text-center">
        <select id="selectGroupe">
            <option value="0" selected>--Choisir un groupe--</option>
            <?php foreach ($groupes as $g){ ?>
                <option value="<?= $g["id"] ?>"><?= $g["titre"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div id="container_table" class="col-lg-12 col-md-12">
        <table id="tablemodif">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Eleve</th>
                    <th>Date & heure</th>
                    <th>Salle</th>
                    <th>Tuteur/Professeur</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div id="container_edition" class="col-lg-12 col-md-12">
    </div>
</div>


<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/edition_notes.js"> </script>

