<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?php echo base_url();?>assets/css/gsdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/gestion_professeurs.css" rel="stylesheet">

<div class="col-lg-10 col-md-10 text-center" id="container_admin">
    <table id="table_prof">
        <thead>
            <th><i class="fa fa-sort" aria-hidden="true"></i>Nom</th>
            <th><i class="fa fa-sort" aria-hidden="true"></i>Prénom</th>
            <th><i class="fa fa-sort" aria-hidden="true"></i>Abréviation</th>
        </thead>

        <tbody>
            <?php foreach($prof as $value){?>
                <tr>
                    <td><?= $value['nom'] ?></td>
                    <td><?= $value['prenom'] ?></td>
                    <td><input type='text' id='<?= $value['id']?>' class='input_abre' value='<?= $value['abreviation']?>'></td>
                </tr>
            <?php }?>
        </tbody>
    </table>

    <button id="valider">Valider</button>
    <a href="<?php base_url('index.php/c_admin/gestionProf');?>"><button id="retablir">Retablir</button></a>

</div>




<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.tablesorter.min.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin_gestion_prof.js"> </script>
