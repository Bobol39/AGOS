<link href="<?=base_url();?>assets/css/notation.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">
<script>
    $( function() {
        $( "#slider" ).slider();
    } );
</script>
<div class="col-lg-12 col-md-12" id="container_notation">
    <div class="col-lg-12 col-md-12" id="block_notation">
        <div class="col-lg-3 col-md-3" style="height: 100%; padding-top: 30px;">
            <table class="tablelignes" style="margin-left: 30px; width: 80%">
                <tr><th>Potentiel Scientifique</div></th></tr>
                <tr><th style="text-align: right">Justesse scientifique - Pertinance</th></tr>
                <tr><th style="text-align: right">Capacité à apprendre</th></tr>
                <tr><th style="text-align: right">Ouverture - Curiosité</th></tr>
                <tr><th>Démarche Scientifique</th></tr>
                <tr><th style="text-align: center">Questionnement - Méthode</th></tr>
                <tr><th style="text-align: center">Résolution de problèmes</th></tr>
                <tr><th style="text-align: center">Communication - Présentation</th></tr>
            </table>
        </div>
        <div class="col-lg-9 col-md-9" style="height: 100%;">
            <div style="position: absolute; width: 100%; height: 100%">
                <table id="tablecolonnes">
                    <tr>
                        <th valign="top">Insuffisant</th>
                        <th valign="top">Superficiel</th>
                        <th valign="top">Moyen</th>
                        <th valign="top">Maîtrisé</th>
                        <th valign="top">N.E</th>
                    </tr>
                </table>
            </div>
            <div style="position: absolute; width: 100%; height: 100%; padding-top: 30px">
                <table class="tablelignes">
                    <tr><th></th></tr>
                    <tr><th>
                            <div id="slider1" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" style="display: inline-block"><input type="checkbox" class="ct-green" checked/></div>
                        </th></tr>
                    <tr><th>
                            <div id="slider2" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                                <input type="checkbox" class="ct-green" checked/>
                            </div>
                        </th></tr>
                    <tr><th>
                            <div id="slider3" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>"><input type="checkbox" class="ct-green" checked/></div>
                        </th></tr>
                    <tr><th></th></tr>
                    <tr><th>
                            <div id="slider4" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" ><input type="checkbox" class="ct-green" checked/></div>
                        </th></tr>
                    <tr><th>
                            <div id="slider5" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" ><input type="checkbox" class="ct-green" checked/></div>
                        </th></tr>
                    <tr><th>
                            <div id="slider6" class="slider-info"></div>
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" ><input type="checkbox" class="ct-green" checked/></div>

                        </th></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12" id="block_textarea">
        <textarea></textarea>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/notation.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/gsdk-bootstrapswitch.js"> </script>
