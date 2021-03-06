<link href="<?php echo base_url();?>assets/css/navbar_notation.css" rel="stylesheet">


<div class="col-lg-12 col-md-12" id="navbar_notation">
    <div class="col-lg-1 col-md-1 button_navbar_notation">
        <span>AGOS</span>
    </div>
    <div class="col-lg-1 col-md-1 button_navbar_notation" id="button_fiche">
        <span>Résumé</span>
    </div>
    <div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2" id="block_titre_soutenance">
        <span><?= $soutenance->titre?></span>
    </div>
    <div class="col-lg-2 col-md-2" id="block_duree">
        <span>Durée: </span>
        <span id="showDuree"></span>
    </div>
    <div class="col-lg-2 col-md-2" id="block_chrono">
        <?php if ($tuteur == 1){ ?>
            <div class="col-lg-6 col-md-6" style="height: 100%; padding: 0px">
                <button class="btn btn-success btn-fill" id="button_debut">Début</button>
            </div>
        <?php }?>

        <div class="col-lg-6 col-md-6">
            <span id="showTimer">00:00</span>
        </div>
    </div>
    <div class="col-lg-2 col-md-2" id="block_next">
        <button class="btn btn-success btn-fill" id="button_next">Valider</button>
    </div>
</div>