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
    <?php if ($_SESSION['role'] == 'admin'){ ?>
        <a href="<?php echo base_url('index.php/c_admin'); ?>">
            <div class="col-lg-2 col-md-2 button_navbar_notation">
                <span>Espace Admin</span>
            </div>
        </a>
    <?php }else{ ?>
        <div class="col-lg-2 col-md-2"></div>
    <?php } ?>


    <a href="<?php echo base_url('index.php/c_prof/'); ?>">
        <div class="col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-7 button_navbar_notation">
            <span>Evaluer</span>
        </div>
    </a>
    <a href="<?php echo base_url('index.php/c_prof/editionNotes'); ?>">
        <div class="col-lg-2 col-md-2 button_navbar_notation">
            <span>Modifier</span>
        </div>
    </a>
</div>