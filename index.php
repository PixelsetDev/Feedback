<?php

ob_start();
session_start();
/**
 * @author      LMWN <contact@lmwn.co.uk>
 * @copyright   Copyright (c), 2022 LMWN & Lewis Milburn
 *
 * This file is a modified version of the demo router provided by https://github.com/bramus/router.
 */

const BASE_URI = '/feedback';

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

// Before OldRouter Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: Boa/OldRouter');
});

// Homepage
$router->get('/', function () {
    require_once __DIR__ . '/common/views/homepage.php';
});

// Categories
$Categories = $SQL->Select('slug', 'categories', '1', 'ALL:ASSOC');
foreach ($Categories as $Category) {
    $router->get('/'.$Category['slug'].'-feedback', function () {
        global $Category;
        require_once __DIR__ . '/common/views/'.$Category['slug'].'-feedback.php';
    });
    $router->post('/'.$Category['slug'].'-feedback', function () {
        require_once __DIR__ . '/common/controllers/feedback-submission.php';
    });
}

// Find Server Information
$router->get('/find-server-information', function () {
    require_once __DIR__ . '/common/views/find-server-information.php';
});

// Projects
$Projects = $SQL->Select('slug', 'projects', '1', 'ALL');
foreach ($Projects as $project) {
    $project = $project[0];

    $router->mount('/'.$project, function () use ($router) {

        $router->get('/', function () {
            require_once __DIR__ . '/common/views/project.php';
        });

        $router->get('/reports', function () {
            require_once __DIR__ . '/common/views/reports.php';
        });

        $router->get('/suggestions', function () {
            require_once __DIR__ . '/common/views/suggestions.php';
        });
    });
}

// Thunderbirds are go!
$router->run();

// EOF
ob_end_flush();
