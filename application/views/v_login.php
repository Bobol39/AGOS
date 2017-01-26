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
                <span>Role:</span>
                <input type="text" value="" name="role" class="form-control" placeholder="admin / prof / eleve"/>
                <span>Login:</span>
                <input type="text" value="" name="login" class="form-control" placeholder="ccouchot / cguyeux / ajossic"/>
                <button  type="submit" class="btn btn-success btn-fill">SE CONNECTER</button></a>
            </div>

        </div>

    </div>
</body>