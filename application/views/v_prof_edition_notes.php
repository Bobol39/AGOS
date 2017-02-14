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
    <div id="container_select" class="col-lg-12 col-md-12 text-center">
        <form action="<?= base_url('/index.php/c_prof/exportNote')?>" method="post">
            <select id="selectGroupe" name="idgroup">
                <option value="0" selected>--Choisir un groupe--</option>
                <?php foreach ($groupes as $g){ ?>
                    <option value="<?= $g["id"] ?>"><?= $g["titre"] ?></option>
                <?php } ?>
            </select>
            <button type="submit" class="btn btn-success" >Exporter les notes de ce groupe</button>
        </form>
    </div>
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
        <div class="col-lg-2 col-lg-offset-8 col-md-2 col-md-offset-8">
            <button id="btnAnnotations" class="btn btn-fill btn-info">Annotations</button>
        </div>
        <div class="col-lg-2 col-md-2 text-center">
            <button id="btnValider" class="btn btn-fill btn-success">Sauvegarder</button>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/edition_notes.js"> </script>

