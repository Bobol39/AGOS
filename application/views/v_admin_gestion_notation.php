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

<div>
    <div>Créer notation</div> <button id="create">Créer</button><button id="modif">Modifier</button>
    <div>Titre du groupe de critère:
        <input type="text" id="input_titre" placeholder="Projets Tut">
        <select id="select_groupe_critere">
            <?php foreach ($groupe_critere as $value){ ?>
                <option value="<?= $value["id"]?>"><?= $value["titre"]?></option>
            <?php } ?>
        </select>
    </div>
    Critères :
    <?php for ($i = 0; $i<6;$i++){ ?>
        <select id="crit<?=$i?>">
            <?php foreach($critere as $value){?>
                <option value="<?= $value["id"] ?>"><?= $value["titre"]." : ".$value["bareme"] ?> </option>
           <?php } ?>
        </select>
    <?php } ?>
    <button id="valider">Valider</button>
</div>

<br>
<br>
<div>Créer un critère <br>
    Titre : <input type="text" id="input_titre_crit"><br>
    Barème : <input type="number" id="input_bar" > <br>
    <button id="valider_crit">Valider</button>
</div>





<script type="text/javascript" src="<?=base_url();?>assets/js/admin_gestion_notation.js"> </script>

