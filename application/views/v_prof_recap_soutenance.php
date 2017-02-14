<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 14/02/2017
 * Time: 19:46
 */
?>
<link href="<?=base_url();?>assets/css/circle.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/recap_notes.css" rel="stylesheet">



<div id="container_prof" class="col-lg-12 col-md-12">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="container_moyennes">
        <div class="col-lg-6 text-center"><h3>Note Finale</h3></div>
        <div class="col-lg-6 text-center"><h3>Note par critère</h3></div>
        <div id="block_moyGenerale" class="col-lg-6 text-center">
            <?php
            $total = 0;
            foreach ($notes as $c){
                $total += $c['note'];
            }
            ?>
            <div class="c100 p<?php echo intval($total*5)." ";
            if (intval($total) < 10) echo "orange"; else if (intval($total) >= 15) echo "green"?>">
                <span>
                    <?php echo $total."/20"?>
                </span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
        </div>
        <div id="block_moyPerCrit" class="col-lg-6">
            <?php
            foreach ($notes as $c){
                ?>
                <div class="block_moyCrit">
                    <div class="col-lg-10"><span><?= $c["titre_critere"] ?></span></div>
                    <div class="col-lg-2">
                        <div class="c100 p<?= intval($c["note"]*5); ?> small">
                            <span><?= $c["note"]; ?>/20</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>


<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
