<link href="<?=base_url();?>assets/css/notation.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/gsdk.css" rel="stylesheet">

<script src="<?=base_url();?>node/node_modules/socket.io-client/dist/socket.io.js"></script>


<div id="fiche_layer">
    <div id="fiche_viewer">
        <div id="fiche_header" class="text-center">
            <span>Resumé de la soutenance</span>
        </div>
        <div id="fiche_body">
            <?= $soutenance[0]['resume']?>
        </div>

    </div>
</div>

<div class="col-lg-12 col-md-12" id="container_notation">
    <div class="col-lg-12 col-md-12" id="block_notation">
        <div class="col-lg-3 col-md-3" style="height: 100%; padding: 30px 0 0;">
            <div class="col-lg-12 col-md-12 linetitleblock" >
                <div class="bigtitleline"></div>
            </div>

            <?php foreach($critere as $value) { ?>
                <div class="col-lg-12 col-md-12 linetitleblock" >
                    <div class="bigtitleline"><?= $value["titre"]?></div>
                </div>
            <?php } ?>

        </div>
        <div class="col-lg-9 col-md-9" style="height: 100%;">
            <div style="position: absolute; width: 100%; height: 100%">
                <table id="tablecolonnes">
                    <tr>
                        <th valign="top">Insuffisant</th>
                        <th valign="top">Superficiel</th>
                        <th valign="top">Moyen</th>
                        <th valign="top">Bon</th>
                        <th valign="top">Excellent</th>
                        <th valign="top">N.E</th>
                    </tr>
                </table>
            </div>
            <div style="position: absolute; width: 100%; height: 100%; padding-top: 30px">
                <div class="col-lg-12 col-md-12 lineblock" ></div>

                <?php for ($i=0;$i<sizeof($critere);$i++){ ?>
                    <div class="col-lg-12 col-md-12 lineblock" >
                        <div class="blockslider col-lg-11 col-md-11">
                            <div id="slider<?= $i+1 ?>" class="slider-info"></div>
                        </div>
                        <div class="blockswitch text-center col-lg-1 col-md-1">
                            <div class="switch" data-on-label="<i class='fa fa-check'></i>" data-off-label="<i class='fa fa-times'></i>" >
                                <input type="checkbox" class="ct-green" checked/>
                            </div>
                        </div>
                    </div>
                <?php } ?>



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
        <canvas id="colors_sketch" width="" height=""></canvas>
        <textarea></textarea>

    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>assets/js/sketch.js"> </script>

<script type="text/javascript" src="<?=base_url();?>assets/js/notation.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/get-shit-done.js"> </script>
<script type="text/javascript" src="<?=base_url();?>assets/js/gsdk-bootstrapswitch.js"> </script>

<script>
    $(function() {
        var socketio = io.connect('http://127.0.0.1:3000/');
        var login = prompt("Login?")
        socketio.emit('notation',{id: "<?=$soutenance[0]['id'];?>", login: login});
        socketio.on("waiting", function () {
            alert("waiting");
            start_loading();
        }).on("stopWaiting", function () {
            alert("stopWaiting");
            stop_loading();
        });
    });
</script>