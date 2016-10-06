<head>
	<style type="text/css">
		body {
			position: absolute;
			top: 0;
			width:100%;
			height:auto;
		}

		.box.login{
			text-align: center;
			margin-top:  50%;
			background-color: lightgrey;
			font-size: 2em;
			width: 99%;
			margin-left: auto;
			margin-right: auto;
		}
		.button {
			margin-top: 4%;
			font-size: 2em;
			height: 7%;
		}

		input {
			font-size: 2em;
			width: 90%;
			text-align: center;
		}

		label {
			font-size: 2em;
		}

		@media screen and (min-width: 1024px){
			input{
				width: 30%;
				font-size: 30px;
			}
			.box.login{
				margin-top: 20%;
			}
			label {
				font-size: 30px;
			}
			.button {
				font-size: 1em;
			}
		}

		@media screen and (max-width: 1024px) {
			input{
				width: 30%;
				font-size: 30px;
			}
			.box.login{
				margin-top: 30%;
			}
			label {
				font-size: 30px;
			}
			.button {
				font-size: 1em;
			}
		}

		@media only screen and (max-device-width: 768px){
			.box.login{
				text-align: center;
				margin-top:  50%;
				background-color: lightgrey;
				font-size: 2em;
			}
			.button {
				margin-top: 4%;
				font-size: 2em;
				height: 7%;
			}

			input {
				font-size: 2em;
				width: 90%;
				text-align: center;
			}

			label {
				font-size: 2em;
			}
		}
	</style>
</head>
<body>
<div class="box login">
	<div class="boxBody">
		<?php echo form_open('c_index/form_valid_connexion'); ?>
		<label for="login">Identifiant :</label>
		<input type="text" name="login" placeholder="login">
		<?php echo form_error('login','<span class="error">',"</span>");?>
		<br><br>
		<label for="pass">Mot de passe :</label>
		<input type="password" name="pass" placeholder="mot de passe">
		<?php echo form_error('pass','<span class="error">',"</span>");?>
		<br>
		<input class="button" type="submit" value="Connexion" />
		<?php if(isset($erreur))echo '<span class="error">'.$erreur."</span>";?>
		<?php echo form_close(); ?>
	</div>
</div>
</body>
