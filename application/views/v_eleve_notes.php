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

    function Soutenance($id, $crit)
    {
        $this->id = $id;
        $this->notes = [$crit];
    }

    function add_note($nom, $note, $bareme)
    {
        array_push($this->notes, new Critere($nom,$note,$bareme));
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
    var $nom;
    var $note;
    var $bareme;

    function  Critere($nom,$note,$bareme){
        $this->nom = $nom;
        $this->note = $note;
        $this->bareme = $bareme;
    }

    function getMoyenne($soutenances){
        $moy = 0; $oc = 0;
        foreach ($soutenances as $s){
            foreach ($s->notes as $n){
                if ($n->nom == $this->nom){
                    $moy+= $n->note;
                    $oc++;
                }
            }
        }
        return $moy/$oc;
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
            $s->add_note($n["id_critere"], $n["note"], 1);
        }
    }
    if (!$found){
        array_push($soutenances, new Soutenance($n["id_soutenance"], new Critere($n["id_critere"], $n["note"], 1)));
    }
}

$criteres = [];
foreach ($soutenances as $s){
    foreach ($s->notes as $n){
        $occurence = 0;
        $foundCrit = false;
        foreach ($criteres as $crit){
            if ($crit->nom == $n->nom){
                $foundCrit = true;
            }
        }
        if (!$foundCrit){
            array_push($criteres, $n);
        }
    }
}
?>

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
            $moy =  round($moy/$nbr, 1);
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
            <?php foreach ($criteres as $c){ ?>
                <div class="block_moyCrit">
                    <div class="col-lg-10"><span><?= $c->nom ?></span></div>
                    <div class="col-lg-2"><span><?= $c->getMoyenne($soutenances); ?></span></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="container_soutenances">
        <?php foreach ($soutenances as $s){ ?>
            <div class="col-lg-6">
                <div class="block_soutenance col-lg-10 col-lg-offset-1">

                </div>
            </div>
        <?php } ?>
        <div class="col-lg-6">
            <div class="block_soutenance col-lg-10 col-lg-offset-1">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="block_soutenance col-lg-10 col-lg-offset-1">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="block_soutenance col-lg-10 col-lg-offset-1">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="block_soutenance col-lg-10 col-lg-offset-1">

            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/set.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/eleve_notes.js"> </script>
