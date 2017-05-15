<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 14/10/2016
 * Time: 14:23
 */
?>

<link href="<?php echo base_url();?>assets/css/leftbar_admin.css" rel="stylesheet">


<div class="col-lg-2 col-md-2" id="leftbar">
    <div class="col-lg-12 col-md-12" id="logo_admin">
        <img src="<?php echo base_url(); ?>assets/img/logo_leftbar_admin.png">
    </div>
    <a href="<?php echo base_url('index.php/c_admin/'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Sessions</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_admin/gestionProf'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Professeurs</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_admin/gestionSalle'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Salles</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_admin/gestionNotation'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Barêmes</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_cas/index'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Importer Promotion</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_cas/update_promo'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin">
            <span>Gestion Promotion</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_prof'); ?>">
        <div class="col-lg-12 col-md-12 button_leftbar_admin" style="margin-top: 30px">
            <span>Espace professeur</span>
        </div>
    </a>
</div>
