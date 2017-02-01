<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 03/12/2016
 * Time: 18:37
 */
?>
<link href="<?=base_url();?>assets/css/choix_soutenance.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">

<div class="col-lg-12 col-md-12 text-center" id="container_choix_soutenance">
    <h1>Choix de la soutenance</h1>
    <h3>Choisir une soutenance à évaluer</h3>
    <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2" id="container_soutenances">
        <div class="row"><h4>Soutenances dont vous êtes le tuteur :</h4>
            <?php
            if (count($soutenances_tuteur) == 0){echo "<span>Vous n'êtes le tuteur d'aucune soutenance</span>";}
            foreach ($soutenances_tuteur as $sout){
            ?>
            <div class="container_soutenance col-lg-3 col-md-3">
                <a href="<?php echo base_url()?>/index.php/C_prof/showNotation/<?php echo $sout["id"]?>">
                    <div class="btn btn-success btn-fill button_soutenance">
                        <div class="col-lg-12 col-md-12 text-center" style="height: 50%;">
                            <span class="titresout"><?= $sout["titre"]; ?></span>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <span class="sallesout"><?= $sout["id_salle"]; ?></span>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                            <span class="glyphicon glyphicon-cog"></span>
                            <span class="dureesout"><?= $sout["duree"];?>mn</span>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="heuresout"><?= date( 'G:i', strtotime($sout["horaire"])); ?></span>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>
        </div>
        <div class="row"><h4>Soutenances dont vous êtes le témoin :</h4>
            <?php
            if (count($soutenances_temoin) == 0){echo "<span>Vous n'êtes le témoin d'aucune soutenance</span>";}
            foreach ($soutenances_temoin as $sout){
                ?>
                <div class="container_soutenance col-lg-3 col-md-3">
                    <a href="<?php echo base_url()?>/index.php/C_prof/showNotation/<?php echo $sout["id"]?>">
                        <div class="btn btn-info btn-fill button_soutenance">
                            <div class="col-lg-12 col-md-12 text-center" style="height: 50%;">
                                <span class="titresout"><?= $sout["titre"]; ?></span>
                            </div>
                            <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <span class="sallesout"><?= $sout["id_salle"]; ?></span>
                            </div>
                            <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="dureesout"><?= $sout["duree"];?>mn</span>
                            </div>
                            <div class="col-lg-4 col-md-4 text-center" style="height: 50%;">
                                <span class="glyphicon glyphicon-time"></span>
                                <span class="heuresout"><?= date( 'G:i', strtotime($sout["horaire"])); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/choix_soutenance.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>

