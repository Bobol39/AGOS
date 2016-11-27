<link href="<?php echo base_url();?>assets/css/navbar_notation.css" rel="stylesheet">


<div class="col-lg-12 col-md-12" id="navbar_notation">
    <div class="col-lg-1 col-md-1 button_navbar_notation">
        <span>AGOS</span>
    </div>
    <div class="col-lg-1 col-md-1 button_navbar_notation" id="button_bilan">
        <span>Bilan</span>
    </div>
    <div class="col-lg-1 col-md-1 button_navbar_notation" id="button_fiche">
        <span>Résumé</span>
    </div>
    <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1" id="block_titre_soutenance">
        <span><?= $soutenance[0]['titre']?></span>
    </div>
    <div class="col-lg-2 col-md-2" id="block_duree">
        <span>Durée: </span>
        <span id="showDuree"></span>
    </div>
    <div class="col-lg-2 col-md-2" id="block_chrono">
        <div class="col-lg-6 col-md-6" style="height: 100%; padding: 0px">
            <button class="btn btn-success btn-fill" id="button_debut">Début</button>
        </div>
        <div class="col-lg-6 col-md-6">
            <span id="showTimer">00:00</span>
        </div>
    </div>
    <div class="col-lg-2 col-md-2" id="block_next">
        <a href="<?php echo base_url("index.php/C_fusion")?>"><button class="btn btn-success btn-fill" id="button_next">Next</button></a>
    </div>
</div>