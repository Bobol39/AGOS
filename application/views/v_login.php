<link href="<?=base_url();?>assets/css/login.css" rel="stylesheet">

<body id="bodylogin">
    <div id="containerLogin">
        <img src="<?=base_url();?>assets/img/logo_cas.png">
        <div id="blocklogin">
            <div id="headerblock">
                <span>AGOS Authentication</span>
            </div>
            <div id="formblock">
                <span>Identifiant:</span>
                <input type="text" value="" class="form-control" />
                <span>Mot de passe:</span>
                <input type="password" value="" class="form-control" />
                <a href="<?php echo base_url("index.php/C_soutenance")?>"><button class="btn btn-success btn-fill">SE CONNECTER</button></a>
            </div>

        </div>

    </div>
</body>