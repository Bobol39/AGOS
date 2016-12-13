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
                <a href="<?php echo base_url()?>/index.php/C_prof/showNotation/<?php echo $sout["id"].'/'.$login; ?>">
                    <button class="btn btn-success btn-fill button_soutenance"><?php echo $sout["titre"]; ?></button>
                </a>
                <a href="<?php echo base_url()?>/index.php/C_prof/showNotation/<?php echo $sout["id"].'/'.$sout["professeur2"];  ?>">acces en tanque que <?php echo $sout["professeur2"];  ?></a>
            </div>

        <?php } ?>
        </div>
        <div class="row"><h4>Soutenances dont vous êtes le témoin :</h4>
            <?php
            if (count($soutenances_temoin) == 0){echo "<span>Vous n'êtes le témoin d'aucune soutenance</span>";}
            foreach ($soutenances_temoin as $sout){
                ?>
                <div class="container_soutenance col-lg-3 col-md-3">
                    <a href="<?php echo base_url()?>/index.php/C_prof/showNotation/<?php echo $sout["id"].'/'.$login;  ?>">
                        <button class="btn btn-info btn-fill button_soutenance"><?php echo $sout["titre"]; ?></button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/choix_soutenance.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>

