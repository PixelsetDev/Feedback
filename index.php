<?php

ob_start();
session_start();
/**
 * @author      LMWN <contact@lmwn.co.uk>
 * @copyright   Copyright (c), 2022 LMWN & Lewis Milburn
 *
 * This file is a modified version of the demo router provided by https://github.com/bramus/router.
 */
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once 'Boa/Boa.php';

$app = new Boa\App();
$router = new Boa\Router\Router();
$SQL = new Boa\Database\SQL();

// Error Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    exit;
});

// Before Router Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: Boa/Router');
});

$result = $SQL->Select('name','projects');

// Homepage
$router->get('/', function () {
    require_once __DIR__ . '/common/views/homepage.php';
});

// Software Feedback
$router->get('/software-feedback', function () {
    require_once __DIR__ . '/common/views/software-feedback.php';
});

// Website Feedback
$router->get('/website-feedback', function () {
    require_once __DIR__ . '/common/views/website-feedback.php';
});

// Thunderbirds are go!
$router->run();

// EOF
ob_end_flush();
