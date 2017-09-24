<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

function send($status,$data)
{
	$json = array(
		"status" => $status,
		"data" => $data
	);

	header('Content-Type: application/json');
	echo json_encode($json);
}

require ROOT . 'vendor/autoload.php';
require APP . 'config/config.php';

use Mini\Core\Application;

$app = new Application();
