<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, PATCH');
header("Access-Control-Allow-Headers: *");

define('DATABASE', 'db');
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', '');

$fe_data = json_decode(file_get_contents('php://input'), true);
