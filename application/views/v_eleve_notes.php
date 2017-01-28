<?php
/**
 * Created by PhpStorm.
 * User: Pelomedusa
 * Date: 04/01/2017
 * Time: 13:17
 */
class Soutenance {

    var $id;
    var $notes;


    function Soutenance($id, $titre, $crit)
    {
        $this->id = $id;
        $this->notes = [$crit];
        $this->titre = $titre;
    }

    function add_note($id,$nom, $note, $bareme)
    {
        array_push($this->notes, new Critere($id,$nom,$note,$bareme));
    }

    function getNote(){
        $note=0;
        foreach ($this->notes as $c){
            $note+=$c->note;
        }
        return $note;
    }

}

class Critere {
    var $id;
    var $nom;
    var $note;
    var $bareme;

    function  Critere($id,$nom,$note,$bareme){
        $this->id = $id;
        $this->nom = $nom;
        $this->note = $note;
        $this->bareme = $bareme;
    }

    function getMoyenne($soutenances){
        $moy = 0; $oc = 0;
        foreach ($soutenances as $s){
            foreach ($s->notes as $n){
                if ($n->id == $this->id){
                    $moy+= $n->note*(20/$n->bareme);
                    $oc++;
                }
            }
        }
        $moy = $moy/$oc;
        return round($moy * 2) / 2;
    }
}
?>

<link href="<?=base_url();?>assets/css/circle.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/eleve_notes.css" rel="stylesheet">


<?php
$moy = 0; $nbr = 0; $total = 0;
$id = null;
$soutenances = [];
foreach ($notes as $n){
    $found =false;
    foreach ($soutenances as $s){
        if ($s->id == $n["id_soutenance"]){
            $found = true;
            $s->add_note($n["id_critere"],$n["titre_critere"], $n["note"], $n["bareme"]);
        }
    }
    if (!$found){
        array_push($soutenances, new Soutenance($n["id_soutenance"], $n["titre"], new Critere($n["id_critere"],$n["titre_critere"], $n["note"], $n["bareme"])));
    }
}

$criteres = [];
foreach ($soutenances as $s){
    foreach ($s->notes as $n){
        $occurence = 0;
        $foundCrit = false;
        foreach ($criteres as $crit){
            if ($crit->id == $n->id){
                $foundCrit = true;
            }
        }
        if (!$foundCrit){
            array_push($criteres, $n);
        }
    }
}

?>


<div id="soutenance_layer">
    <div id="soutenance_viewer">
        <div id="soutenance_header" class="text-center">
            <span>Resumé de la soutenance</span>
        </div>
        <div id="soutenance_body" class="text-center">
            <div class="row">
                <h3>Note globale</h3><br>
                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
                    <div class="c100 p50">
                        <span>50</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Note détaillée</h3><br>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="block_note_detaillee">
                    <div class="block_moyCrit">
                        <div class="col-lg-10"><span>Crit</span></div>
                        <div class="col-lg-2">
                            <div class="c100 p50 small">
                                <span>20</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12" id="container_eleve">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="container_moyennes">
        <div class="col-lg-6 text-center"><h3>Moyenne Generale</h3></div>
        <div class="col-lg-6 text-center"><h3>Moyenne par critère</h3></div>
        <div id="block_moyGenerale" class="col-lg-6 text-center">
            <?php
            $moy = 0; $nbr=0;
            foreach ($soutenances as $sout){
                $moy+=$sout->getNote();
                $nbr++;
            }
            if ($nbr == 0){
                $moy = "";
            } else {
                $moy =  round($moy/$nbr, 1);
            }
            ?>
            <div class="c100 p<?php echo intval($moy*5)." ";
            if (intval($moy) < 10) echo "orange"; else if (intval($moy) >= 15) echo "green"?>">
                <span>
                    <?php echo $moy."/20"?>
                </span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
        </div>
        <div id="block_moyPerCrit" class="col-lg-6">
                <?php
                if (sizeof($criteres) == 0){
                    echo "<h4 class='nothingtoshow'>Vous n'avez aucun critère noté pour le moment</h4>";
                }
                foreach ($criteres as $c){
                ?>
                <div class="block_moyCrit">
                    <div class="col-lg-10"><span><?= $c->nom ?></span></div>
                    <div class="col-lg-2">
                        <div class="c100 p<?= intval($c->getMoyenne($soutenances)*5); ?> small">
                            <span><?= $c->getMoyenne($soutenances); ?>/20</span>
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
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="container_soutenances">
        <?php
        if (sizeof($soutenances) == 0){
            echo "<h4 class='nothingtoshow'>Vous n'avez aucune soutenance notée pour le moment</h4>";
        }
        foreach ($soutenances as $s){
            ?>
            <div class="col-lg-6">
                <div class="block_soutenance col-lg-10 col-lg-offset-1">
                    <div class="col-lg-10">
                        <span class="titre_soutenance"><?= $s->titre?></span>
                    </div>
                    <div class="col-lg-2">
                        <div class="c100 p<?php echo intval($s->getNote()*5)." ";
                        if ($s->getNote() < 10) echo "orange"; else if ($s->getNote() >= 15) echo "green"?> small">
                            <span><?= $s->getNote(); ?>/20</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="soutid" value="<?= $s->id ?>">
                </div>
            </div>
        <?php } ?>

    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/set.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/eleve_notes.js"> </script>

