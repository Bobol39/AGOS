<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AGOS</title>
    <link rel="icon" href="<?=base_url();?>assets/img/favicon.ico">

    <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/global.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/loading.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.css">

    <script src="<?=base_url();?>assets/js/jquery-3.1.1.min.js"  crossorigin="anonymous"></script>
    <script src="<?=base_url();?>assets/js/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/global.js"> </script>
    <script>
        var baseurl = '<?php echo base_url();?>';
    </script>

    <div id="notification" style="display: none">
        <div>
            <h4></h4>

        </div>
        <span id="textnotif"></span>
    </div>

    <div class="text-center" id="loading_layer" style="display: none">
        <div class="in_up"></div>
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner one2"></div>
            <div class="inner two"></div>
            <div class="inner two2"></div>
            <div class="inner three"></div>
            <div class="inner three2"></div>
            <div class="load">Chargement...</div>
            <div class="loading_iut"><img src="<?=base_url();?>/assets/img/iut.png"></div>
        </div>
    </div>
    <div class="text-center" id="waiting_layer" style="display: none">
        <div class="in_up"></div>
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner one2"></div>
            <div class="inner two"></div>
            <div class="inner two2"></div>
            <div class="inner three"></div>
            <div class="inner three2"></div>
            <div class="load">Chargement...</div>
            <div class="loading_iut"><img src="<?=base_url();?>/assets/img/reseau.png"></div>
        </div>
    </div>

    </head>