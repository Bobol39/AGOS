<?php
/**
 * Created by PhpStorm.
 * User: Bobol
 * Date: 24/10/2016
 * Time: 14:34
 */
?>

<script>
    var baseurl = '<?php echo base_url();?>';
</script>


<link href="<?php echo base_url();?>assets/css/gestion_notation.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/gsdk.css" rel="stylesheet">

<div class="col-lg-10 col-md-10" id="container_admin">
    <div id="container_groupe_notation" class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
        <div class="row">
            <h2>Créer un groupe de notation</h2>
            <form>
                <div class="col-lg-2 col-lg-offset-4">
                    <label class="radio ct-green">
                        <input type="radio" name="groupcreermodifier" data-toggle="radio" id="radioCreer" value="creer" checked>
                        <i></i>Creer
                    </label>
                </div>
                <div class="col-lg-2">
                    <label class="radio ct-blue">
                        <input type="radio" name="groupcreermodifier" data-toggle="radio" id="radioModif" value="modifier">
                        <i></i>Modifier
                    </label>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                <h4>Titre du groupe de critère:</h4>
                <input type="text" id="input_titre" class="form-control" placeholder="Projets Tut">
                <select id="select_groupe_critere">
                    <?php foreach ($groupe_critere as $value){ ?>
                        <option value="<?= $value["id"]?>"><?= $value["titre"]?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12" id="choice_critere">
                <h4>Critères :</h4>
                <div class="col-lg-12" id="container_crits">
                <?php for ($i = 0; $i<4;$i++){ ?>
                    <div class="crit_div">
                        <select class="crit">
                        <?php foreach($critere as $value){?>
                            <option value="<?= $value["id"] ?>"><?= $value["titre"] ?> </option>
                        <?php } ?>
                        </select>
                        <input type="number" class="bareme" placeholder="bareme">
                    </div>
                <?php } ?>
                    </div>
                <button id="add_critere" class="btn btn-info">+</button>
                <button id="moins_critere" class="btn btn-info">-</button>
                <button id="valider" class="btn btn-success">Valider</button>
            </div>
        </div>
    </div>
    <div id="container_creer_critere" class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
        <h2>Créer un critère</h2>
        <h4>Titre : </h4>
        <input type="text" id="input_titre_crit" class="form-control">
        <button id="valider_crit" class="btn btn-success">Valider</button>
    </div>

</div>





<script type="text/javascript" src="<?=base_url();?>assets/js/admin_gestion_notation.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/gsdk-radio.js"> </script>

