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
        <img src="<?php echo base_url();?>assets/img/logo_leftbar_admin.png">
    </div>
    <div class="col-lg-12 col-md-12 button_leftbar_admin">
        <a href="<?php echo base_url('index.php/c_admin/');?>"><span>Sessions</span></a>
    </div>
    <div class="col-lg-12 col-md-12 button_leftbar_admin">
        <a href="<?php echo base_url('index.php/c_admin/gestionProf');?>"><span>Gestion professeur</span></a>
    </div>
    <div class="col-lg-12 col-md-12 button_leftbar_admin">
        <a href="<?php echo base_url('index.php/c_admin/gestionSalle');?>"><span>Gestion salles</span></a>
    </div>
    <div class="col-lg-12 col-md-12 button_leftbar_admin">
        <a href="<?php echo base_url('index.php/c_admin/gestionNotation');?>"><span>Gestion notation</span></a>
    </div>
</div>