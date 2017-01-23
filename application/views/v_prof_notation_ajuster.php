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
        <div id="body_ajuster">
            <?php foreach ($critere as $c){ ?>
                <h3><?= $c["titre"] ?></h3>
                <div class="bareme_choose">
                    <?php for ($i = 0; $i<= $c["bareme"]; $i += 0.5) { ?>
                        <button class="btn btn-info btn-sm button_bareme"><?=$i;?></button>
                    <?php } ?>
                </div>
            <?php } ?>

            <div style="width: 100%" class="text-center"><button id="validerBareme" class="btn btn-success" >Valider</button></div>
        </div>
    </div>
</div>

