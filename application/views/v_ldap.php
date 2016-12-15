<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//array_shift($students);
?>

<?php
echo ("Nb de résultats".$students['count']. '<br />');


    foreach($students as $student){
        echo '<p>';
        //Affichage des info utilisateur pour les tests uniquement
        echo "Nom: ".$student["sn"][0] . '<br />';
        echo "Prenom: ".$student["givenname"][0]. '<br />';
        echo "Mail: ".'mail',$student["mail"][0]. '<br />'; //rajouter [0] si c'est un array
        echo "Etape diplome (Promo): ".$student["ufclibelleetape"][0]. '<br /> <br />';
        echo '</p>';
    }
?>
</div>