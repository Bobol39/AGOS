<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?php echo base_url();?>assets/css/gsdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/gestion_salles.css" rel="stylesheet">
<script>
    var baseurl = '<?php echo base_url();?>';
</script>

<div class="col-lg-10 col-md-10 text-center" id="container_admin">
    <table id="table_salles">
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

    <div class="form-group">
        <h3>Création d'une salle</h3>
        <input type="text" class="form-control" placeholder="Nom de la salle" id="input_name_salle"><br>
        <button id="createSalle">Valider</button>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.tablesorter.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin_gestion_salles.js"> </script>

