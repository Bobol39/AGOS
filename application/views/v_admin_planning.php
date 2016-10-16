<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 14/10/2016
 * Time: 14:22
 */
?>

<link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/jquery.timepicker.css" rel="stylesheet">


<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_planning">
        <div id="container_titres_colonnes" class="col-lg-11 col-md-11">
            <table>
                <tr>
                    <th>TIME</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mecredi</th>
                    <th>Jeudi</th>
                </tr>
            </table>
        </div>
        <div class="col-lg-11 col-md-11" id="container_soutenances">
            <table>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-lg-1 col-md-1" id="container_controls_planning">
            <div id="container_addline" class="col-lg-12">
                <button class="btn btn-info" id="addline">Ajouter ligne</button>
            </div>
        </div>
        <div class="col-lg-12" id="container_modif_soutenances">
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/planning.js"> </script>

