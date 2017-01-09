<?php
/**
 * Created by PhpStorm.
 * User: pelomedusa
 * Date: 08/10/2016
 * Time: 19:06
 */
?>

<link href="<?php echo base_url();?>assets/css/navbar_fusion.css" rel="stylesheet">


<div class="col-lg-12 col-md-12" id="navbar_fusion">
    <div class="col-lg-1 col-md-1 button_navbar_fusion">
        <span>AGOS</span>
    </div>
    <div class="col-lg-1 col-md-1 button_navbar_fusion" id="button_fiche">
        <span>Résumé</span>
    </div>
    <div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2" id="block_titre_soutenance">
        <span><?= $soutenance->titre; ?></span>
    </div>
    <div class="col-lg-1 col-lg-offset-3 col-md-1 col-md-offset-4 button_navbar_fusion" id="timeblock">
        <span>--:--</span>
    </div>
</div>