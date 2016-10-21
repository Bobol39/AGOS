<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    var baseurl = '<?php echo base_url();?>';
</script>

<table>
    <thead>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Abréviation</th>
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
<a href="<?php base_url('index.php/c_admin/gestionProf');?>"><button>Default</button></a>



<script type="text/javascript" src="<?=base_url();?>assets/js/admin_prof.js"> </script>
