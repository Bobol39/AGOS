<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 15/12/2016
 * Time: 16:05
 */
?>

<div id="ajuster_layer">
    <div id="block_ajuster">
        <div id="header_ajuster" class="text-center">
            <span>Ajuster vos notes</span>
        </div>
        <div id="body_ajuster" class="text-center">
            <?php foreach ($critere as $c){ ?>
            <h3><?= $c["titre"] ?></h3>
                <div class="bareme_choose" id="<?= "bareme".$c["bareme"] ?>">
                    <button class="btn btn-info btn-sm button_bareme" value="0">Ins.</button>
                    <button class="btn btn-info btn-sm button_bareme" value="1">Sup.</button>
                    <button class="btn btn-info btn-sm button_bareme" value="2">Moy.</button>
                    <button class="btn btn-info btn-sm button_bareme" value="3">Bon</button>
                    <button class="btn btn-info btn-sm button_bareme" value="4">Exc.</button>
                </div>
            <?php } ?>

            <button id="validerBareme" class="btn btn-success">Valider</button>
        </div>
    </div>
</div>

