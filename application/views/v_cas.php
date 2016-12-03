<?php
/**
 * Created by PhpStorm.
 * User: Yeso
 * Date: 23/10/2016
 * Time: 19:45
 */
?>
<?php

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// for this test, simply print that the authentication was successfull
?>
<html>
<head>
    <title>phpCAS simple client with HTML output customization</title>
</head>
<body>
<h1>Successfull Authentication!</h1>
<?php //require 'script_info.php' ?>
<p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
<p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
<p>User Attributes are</p>
<h3>User Attributes</h3>
<ul>
    <?php
    foreach (phpCAS::getAttributes() as $key => $value) {
        if (is_array($value)) {
            echo '<li>', $key, ':<ol>';
            foreach ($value as $item) {
                echo '<li><strong>', $item, '</strong></li>';
            }
            echo '</ol></li>';
        } else {
            echo '<li>', $key, ': <strong>', $value, '</strong></li>' . PHP_EOL;
        }
    }
    ?>
</ul>
<p><b><a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?logout" ?>">Logout </a></b></p>
<?php

// Initialisation des variables
$ldap_server = "";
// ldap2.univ-fcomte.fr
$ldaphostIP = "172.20.194.95";
$ldaphost1 = "ldaps://ldaps.univ-fcomte.fr";  // votre serveur LDAP
$ldaphost2 = "ldap://ldap.univ-fcomte.fr";  // votre serveur LDAP
$ldapport1 = 606;
$ldapport2 = 389;
$auth_dn = 'ihajali';
$auth_pass = 'yesadolyon00769*';

$connect = ldap_connect($ldaphost2,$ldapport2);
if($connect)
    echo '<p>connect ok</p>';
else
    echo '<p>connect Nok</p>';

if (ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3))
    echo '<p>Version LDAPv3</p>';
else
    echo '<p>Impossible de modifier la version du protocole à 3</p>';

if (ldap_set_option($connect, LDAP_OPT_REFERRALS, 0) )
    echo '<p>LDAP_OPT_REFERRALS ok</p>';
else
    echo '<p>LDAP_OPT_REFERRALS Nok</p>';


$bind = ldap_bind($connect);
if($bind)
    echo '<p>bind ok</p>';
else
    echo '<p>bind Nok</p>';
/*
$ldaphost = "ldap.univ-fcomte.fr";  // votre serveur LDAP
$ldapport = 389;                 // votre port de serveur LDAP
$auth_user = '';
$auth_pass = 'mdp';


// Connexion LDAP
$ldapconn = ldap_connect($ldaphost)
or die("Impossible de se connecter au serveur LDAP $ldaphost");


if ($ldapconn) {

    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // Vérification de l'authentification
    if ($ldapbind) {
        echo "Connexion LDAP réussie...";
    } else {
        echo "Connexion LDAP échouée...";
    }

}
*/
?>
</body>
</html>
