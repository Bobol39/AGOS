<link href="<?=base_url();?>assets/css/eleve.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/markitup.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/markupeditor.css" />

<div class="col-lg-12 col-md-12" id="container_eleve">
    <div class="col-lg-12 col-md-12" id="container_titre">
        <h3>Titre de la soutenance</h3>
        <div class="form-group">
            <input type="text" id="input_titre" placeholder="Entrez un titre" class="form-control" />
        </div>
    </div>
    <div class="col-lg-12 col-md-12" id="container_markup">
        <h3>Résumé</h3>
        <a href="" id="lien"></a>
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" id="container_upload">
            <textarea id="markup_editor" cols="80" rows="20"></textarea>
            <button class="btn btn-success" id="confirmer">Confirmer</button>
        </div>

    </div>


</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/set.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.markitup.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/eleve.js"> </script>
