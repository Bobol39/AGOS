<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 14/10/2016
 * Time: 14:22
 */
?>

<link href="<?php echo base_url();?>assets/css/planning.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/jquery.timepicker.css" rel="stylesheet">


<div class="col-lg-10 col-md-10" id="container_admin">
    <div class="col-lg-12 col-md-12" id="container_planning">
        <div class="col-lg-11 col-md-11" id="container_soutenances">
            <div id="tabs" style="height: 100%">
                <ul>
                    <li><a href="#tabs-1">Nunc tincidunt</a></li>
                    <li><a href="#tabs-2">Proin dolor</a></li>
                    <li><a href="#tabs-3">Aenean lacinia</a></li>
                </ul>
                <div id="tabs-1">
                    <table>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id="tabs-2">
                    <table>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id="tabs-3">
                    <table>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1" id="container_controls_planning">
            <div id="container_addline" class="col-lg-12 col-md-12">
                <button class="btn btn-info" id="addline">Ajouter ligne</button>
            </div>
        </div>
        <div class="col-lg-11 col-md-11" id="container_modif_soutenances">
            <div class="col-lg-12 col-md-12" id="block_modif_titresoutenance">
                <span>Titre: </span>
                <select id="select_titre">
                    <option>Soutenance 1</option>
                    <option>Soutenance 2</option>
                    <option>Soutenance 3</option>
                    <option>Soutenance 4</option>
                    <option>Soutenance 5</option>
                </select>
            </div>
            <div class="col-lg-3 col-lg-3" id="block_modif_prof1">
                <h3>Professeur 1 (Tuteur)</h3>
                <select class="form-control" >
                    <?php /*foreach ($prof as $value){ */?>
                        <option value="<?/*= $value["id"]*/?>"><?/*= $value["nom"]." ".$value["prenom"]*/?></option>
                    <?php /*}*/?>
                </select>
            </div>
            <div class="col-lg-6 col-lg-6" id="block_modif_elevessalle">
                <div id="block_modif_eleves" class="col-lg-9 col-md-9">
                    <h4>Eleves</h4>
                    <div class="col-lg-6">
                        <input type="text" value="" placeholder="Input" class="form-control" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" value="" placeholder="Input" class="form-control" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" value="" placeholder="Input" class="form-control" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" value="" placeholder="Input" class="form-control" />
                    </div>
                </div>
                <div id="block_modif_salle" class="col-lg-3 col-md-3">
                    <h4>Salle</h4>
                    <div class="col-lg-12">
                        <select class="form-control">
                            <?php /*foreach($salle as $value){
                                echo "<option value='".$value["id"]."'>".$value["nom"]."</option>";
                            }*/?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-lg-3" id="block_modif_prof2">
                <h3>Professeur 2</h3>
                <select class="form-control" >
                    <?php /*foreach ($prof as $value){ */?>
                        <option value="<?/*= $value["id"]*/?>"><?/*= $value["nom"]." ".$value["prenom"]*/?></option>
                    <?php /*}*/?>
                </select>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.timepicker.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/planning.js"> </script>

