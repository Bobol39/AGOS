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


</body>
</html>
