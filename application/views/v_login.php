<link href="<?=base_url();?>assets/css/login.css" rel="stylesheet">

<body id="bodylogin">
    <div id="containerLogin">
        <img src="<?=base_url();?>assets/img/logo_cas.png">
        <div id="blocklogin">
            <div id="headerblock">
                <span>AGOS Authentication</span>
            </div>
            <div id="formblock">
                <?php echo form_open('c_index/form_valid_connexion'); ?>
                <span>Identifiant:</span>
                <input type="text" value="" name="login" class="form-control" placeholder="admin / prof / eleve"/>
                <span>Mot de passe:</span>
                <input type="password" value="" name="password" class="form-control" />
                <input class="button" type="submit" value="Connexion mult" />
                <a href="<?php echo base_url("index.php/C_notation")?>"><div class="btn btn-success btn-fill">SE CONNECTER</div></a>
            </div>

        </div>

    </div>
</body>