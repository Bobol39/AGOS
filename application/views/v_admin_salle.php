<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    var baseurl = '<?php echo base_url();?>';
</script>

<table>
    <thead>
        <th>Salles</th>
        <th>Suppression</th>
    </thead>
    <tbody>
    <?php foreach($salle as $value){
        echo "<tr>";
        echo "<td>".$value["nom"]."</td>";
        echo "<td><button id='".$value["id"]."' class='supprSalle'>Supprimer</button></td>";
        echo "</tr>";
    }?>
    </tbody>
</table>

<br>
<!-- Je sais c'est dégueu -> Tu peux m'enlever tout ca duchesse -->
<br>

<div><div id="titre">Création d'une salle</div>
    Nom: <input type="text" id="input_name_salle"><br>
    <button id="createSalle">Valider</button>
</div>






<script type="text/javascript" src="<?=base_url();?>assets/js/admin_salle.js"> </script>

