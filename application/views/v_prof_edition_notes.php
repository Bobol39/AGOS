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



<div id="container_prof" class="col-lg-12 col-md-12">
    <form action="<?= base_url('/index.php/c_prof/exportNote')?>" method="post">
        <div id="container_select" class="col-lg-12 col-md-12 text-center">

            <select id="selectGroupe" name="idgroup">
                <option value="0" selected>--Choisir un groupe--</option>
                <?php foreach ($groupes as $g){ ?>
                    <option value="<?= $g["id"] ?>"><?= $g["titre"] ?></option>
                <?php } ?>
            </select>

            <div id='selectGroupeButton' class="col-lg-12 col-md-12 text-center">
                <button id="button_export" type="submit" class="btn btn-success" style="display: none;">Exporter les notes de ce groupe</button>
            </div>
        </div>

    </form>
    <div id="container_table" class="col-lg-12 col-md-12">
        <table id="tableShow">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Eleve</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Salle</th>
                    <th>Tuteur/Professeur</th>
                    <th>Note</th>
                    <th>Voir le detail</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div id="container_edition" class="col-lg-12 col-md-12">
        <table id="tableEditNote">
            <thead>
            <tr>
                <th>Critère</th>
                <th>Note</th>
                <th>Bareme</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <input type="hidden" id="inputIdSout" value="">
        <button id="btnValider" class="btn btn-fill btn-success">Sauvegarder</button>
    </div>
</div>


<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/edition_notes.js"> </script>

