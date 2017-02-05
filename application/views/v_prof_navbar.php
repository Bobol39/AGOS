<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 03/02/2017
 * Time: 17:06
 */
?>

<link href="<?php echo base_url(); ?>assets/css/navbar_prof.css" rel="stylesheet">


<div class="col-lg-12 col-md-12" id="navbar_notation">
    <div class="col-lg-1 col-md-1 button_navbar_notation">
        <span>AGOS</span>
    </div>


    <a href="<?php echo base_url('index.php/c_prof/'); ?>">
        <div class="col-lg-2 col-lg-offset-7 col-md-2 col-md-offset-7 button_navbar_notation">
            <span>Evaluer</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_prof/editionNotes'); ?>">
        <div class="col-lg-2 col-md-2 button_navbar_notation">
            <span>Modifier</span>
        </div>
    </a>
</div>