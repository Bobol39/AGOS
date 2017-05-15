<?php
/**
 * Created by PhpStorm.
 * User: pelomedusa
 * Date: 09/10/2016
 * Time: 19:03
 */
?>
<link href="<?=base_url();?>assets/css/fusion.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">

<script>
    var id_soutenance = <?=$soutenance->id;?>;
    var critere = <?php echo json_encode($critere); ?>;
</script>

<div id="fiche_layer">
    <div id="fiche_viewer">
        <div id="fiche_header" class="text-center">
            <span>Resumé de la soutenance</span>
        </div>
        <div id="fiche_body">
            <?= $soutenance->resume ?>
        </div>

    </div>
</div>

<div id="fiche_layer_commentaire">
    <div id="fiche_viewer_commentaire">
        <div id="fiche_header_commentaire" class="text-center">
            <span>Vos commentaires</span>
        </div>
        <div id="fiche_body_commentaire">
            <div class="commentaire_case">
                <?= $commentaire[0]->text_note ?>
            </div>
            <div class="commentaire_case">
                <img src="<?=base_url();?>assets/img/img_canvas/<?=$commentaire[0]->img_note;?>" >
            </div>
        </div>

    </div>
</div>


<div class="col-lg-12 col-md-12" id="container_fusion">
    <div class="col-lg-10 col-md-10" id="block_sliders">
        <div style="width: 98%; height: 93%; position:absolute">
            <table id="tablecolonnes">
                <tr>
                    <th valign="top">Insuffisant (I)</th>
                    <th valign="top">Superficiel (S)</th>
                    <th valign="top">Moyen (M)</th>
                    <th valign="top">Bon (B)</th>
                    <th valign="top">Excellent (E)</th>
                </tr>
            </table>
        </div>
        <div style="position: absolute; width: 98%; height: 93%; padding-top: 30px; overflow-y: auto;">
            <?php for ($i=0;$i<sizeof($critere);$i++){ ?>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div id="slider<?php echo $i; ?>" class="slider-info"></div>
                </div>
            <?php } ?>
        </div>

    </div>
    <div class="col-lg-2 col-md-2" id="block_deliberer">
        <div class="col-lg-10 col-lg-offset-1 " id="block_button_deliberer">
            <button class="btn btn-success btn-fill">Délibérer</button>
        </div>
        <div class="col-lg-8 col-lg-offset-2 " id="block_button_retour">
            <button class="btn btn-warning btn-fill">Retour à la liste</button>
        </div>
    </div>
    <div class="col-lg-10 col-md-10" id="block_moyennes">
        <?php   foreach($critere as $c){ ?>
            <div class="col-lg-4 titleline text-center">
                <span><?= $c["titre"] ?></span>
            </div>
            <div class="col-lg-8 container_buttons_moyennes line1">
                <?php for ($i = 0; $i<= $c["bareme"]; $i += 0.5) { ?>
                    <button class="btn btn-default button_bareme"><?=$i;?></button>
                <?php } ?>
            </div>
        <?php } ?>

    </div>
    <div class="col-lg-2 col-md-2" id="block_note_finale">
        <div class="col-lg-8 col-lg-offset-2 " id="block_button_note_finale">
            <button class="btn btn-info btn-fill">
                <span>Note finale</span>
                <span>20</span>
            </button>
        </div>
    </div>
</div>

<script>
    <?php
    $file = base_url()."/assets/js/secret/config.js";

    readfile($file);
    ?>
</script>
<script type="text/javascript" src="<?=base_url();?>assets/js/fusion.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/gsdk-bootstrapswitch.js"> </script>
<script src="<?=base_url();?>node/node_modules/socket.io-client/dist/socket.io.js"></script>

<script>
    $(function() {
        runSocketIo("<?=$soutenance->id;?>",<?=$tuteur;?>);
    });
</script>
