<?php

require __DIR__ . '/../../vendor/autoload.php';
$container = require __DIR__ . '/../../config/container.php';


if (!isset($_GET['user'], $_GET['lang'])) {
    http_response_code(400);

    $message = 'Both "user" and "lang" are required parameters';

    require __DIR__ . '/../template/error.phtml';
    return;
}

$user = $_GET['user'];
$lang = $_GET['lang'];

try {
    $message = $container['greet']($user, $lang);

    require __DIR__ . '/../template/greeting.phtml';
} catch (Exception $e) {
    http_response_code(500);

    $message = $e->getMessage();

    require __DIR__ . '/../template/error.phtml';
}