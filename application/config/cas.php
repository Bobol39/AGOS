<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['cas_server_url'] = 'https://cas.univ-fcomte.fr/cas';
$config['phpcas_path'] = BASEPATH.'../application/libraries/CAS-1.3.4';
$config['cas_disable_server_validation'] = TRUE;
$config['cas_debug'] = TRUE; // <--  use this to enable phpCAS debug mode