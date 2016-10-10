<link href="<?=base_url();?>assets/css/notation.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">

<div class="col-lg-12 col-md-12" id="container_notation">
    <div class="col-lg-12 col-md-12" id="block_notation">
        <div class="col-lg-3 col-md-3" style="height: 100%; padding: 30px 0 0;">
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <div class="bigtitleline">Potentiel Scientifique</div>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Justesse scientifique - Pertinance</span>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Capacité à apprendre</span>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Ouverture - Curiosité</span>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <div class="bigtitleline">Démarche Scientifique</div>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Questionnement - Méthode</span>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Résolution de problèmes</span>
            </div>
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <span class="titleline">Communication - Présentation</span>
            </div>
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
                <div class="col-lg-12 col-md-12 lineblock" >

                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider1" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider2" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider3" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 lineblock" >

                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider4" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider5" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 lineblock" >
                    <div class="blockslider col-lg-11 col-md-11">
                        <div id="slider6" class="slider-info"></div>
                    </div>
                    <div class="blockswitch text-center col-lg-1 col-md-1">
                        <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                            <input type="checkbox" class="ct-green" checked/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12" id="block_textarea">
        <div class="tools">
            <button id="switchtextdraw" class="switchtext"></button>
            <a class="option_draw" href="#colors_sketch" data-color="black" data-size="3" ><button style="background-image: url('<?=base_url();?>assets/img/marker.png')"></button></a>
            <a class="option_draw" href="#colors_sketch" data-color="white" data-size="20" ><button style="background-image: url('<?=base_url();?>assets/img/eraser.png')"></button></a>
            <a class="option_draw" href="#colors_sketch" data-size="3" ><button style="background-image: url('<?=base_url();?>assets/img/dot_small.png')"></button></a>
            <a class="option_draw" href="#colors_sketch" data-size="5" ><button style="background-image: url('<?=base_url();?>assets/img/dot_medium.png')"></button></a>
            <a class="option_draw" href="#colors_sketch" data-size="10" ><button style="background-image: url('<?=base_url();?>assets/img/dot_big.png')"></button></a>
            <button id="textless" class="option_text" style="background-image: url('<?=base_url();?>assets/img/textless.png')"></button>
            <button id="textplus" class="option_text" style="background-image: url('<?=base_url();?>assets/img/textplus.png')"></button>
            <a class="option_draw" href="#colors_sketch" data-color="red" ><button class="colorpicker" style="background-color: red"></button></a>
            <a class="option_draw" href="#colors_sketch" data-color="green" ><button class="colorpicker" style="background-color: green"></button></a>
            <a class="option_draw" href="#colors_sketch" data-color="black" ><button class="colorpicker" style="background-color: #0f0f0f"></button></a>

        </div>
        <canvas id="colors_sketch"></canvas>
        <textarea></textarea>

    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/sketch.js"> </script>

<script type="text/javascript" src="<?=base_url();?>assets/js/notation.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/gsdk-bootstrapswitch.js"> </script>
