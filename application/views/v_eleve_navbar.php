<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 24/10/2016
 * Time: 09:53
 */
?>

<link href="<?php echo base_url();?>assets/css/navbar_eleve.css" rel="stylesheet">


<div class="col-lg-12 col-md-12" id="navbar_eleve">
    <div class="col-lg-1 col-md-1" id="logo_eleve">
        <span>AGOS</span>
    </div>

    <div class="col-lg-1 col-md-1 button_navbar_eleve" id="importer">
        <label for="import">
            <span><i class="fa fa-download" aria-hidden="true"></i></span>
            <input type="file" id="import" style="display:none">
        </label>
    </div>
    <div class="col-lg-1 col-md-1 button_navbar_eleve" id="exporter">
        <span><i class="fa fa-upload" aria-hidden="true"></i></span>
    </div>
    <div class="col-lg-2 col-lg-offset-7 col-md-2 col-md-offset-7 button_navbar_eleve" id="disconnect">
        <span>Se déconnecter</span>
    </div>
</div>