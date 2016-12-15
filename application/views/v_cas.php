<?php
/**
 * Created by PhpStorm.
 * User: Yeso
 * Date: 23/10/2016
 * Time: 19:45
 */
?>
<link href="<?php echo base_url();?>assets/css/gsdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/gestion_salles.css" rel="stylesheet">
<div class="col-lg-10 col-md-10 text-center" id="container_admin">
<h1>Successfull Authentication!</h1>
<?php //require 'script_info.php' ?>
<p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
<p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
<p><b><a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?logout" ?>">Logout </a></b></p>


