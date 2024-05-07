<?php
defined('BASEPATH') or exit('No direct script access allowed');



$active_group = 'default';
$query_builder = true;


$production = filter_var(getenv("PRODUCTION", false), FILTER_VALIDATE_BOOLEAN);

$db['default'] = array(
    'dsn' => '',
    
    'hostname' => getenv("DB_HOST"),
    'username' => getenv("DB_USERNAME"),
    'password' => getenv("DB_PASSWORD"),
    'database' => getenv("DB_DATABASE"),
    'dbdriver' => getenv("DB_DRIVER"),
    
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => ($production) ? false : true,
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => array(),
    'save_queries' => true
);

