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

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Liste des nageurs dans ce créneau horaire:</h4>
                Place restante : <span id="placeRestante" ></span>
            </div>
            <div class="modal-body">
                <table id="tableModal">
                    <tr id="firstRow">
                        <td>Nom</td>
                        <td>Prénom</td>
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Modifier ce créneau</button>
                <button type="button" class="btn btn-primary">Supprimer ce créneau</button>
                <a id="bouttonPrint">
                    <button type="button"  class="btn btn-primary">Imprimer cette liste</button>
                </a>
            </div>
        </div>
    </div>
</div>


