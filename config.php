<?php

define('DB_SERVER', 'REPLACE_WITH_HOST_NAME_OR_IP');
define('DB_NAME', 'REPLACE_WITH_DB_NAME');
define('DB_USERNAME', 'REPLACE_WITH_DB_USER');
define('DB_PASSWORD', 'REPLACE_WITH_DB_PASSWORD');
define('DOMAIN', 'https://petshop23.herokuapp.com/');

$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, 3306);
$db->set_charset("utf8");
date_default_timezone_set('Europe/Athens');

if (!$db) {
    die("Connection failed: " . $db->error);
}

$db->query("SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");

session_start();
