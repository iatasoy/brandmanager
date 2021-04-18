<?php

define("DEFAULT_LANGUAGE",'en');
session_start();

require 'vendor/autoload.php';
require 'autoload.php';

$configObj = new Configuration(__DIR__);
$configObj->SetRouteConfiguration(new RouteConfiguration());
$configObj->SetMessageContainer(new MessageContainer(DEFAULT_LANGUAGE));

$slim3Configuration = new \Slim\Container($configObj->GetSlim3ContainerSetting());

$app = new \Slim\App($slim3Configuration);

$containerConfiguration = $app->getContainer();

$containerConfiguration['view'] = function (
    $newContainer
) {
    global $configObj;
    $view = new \Slim\Views\Twig(
        'html/'
        /*,
        [
            'cache' => 'html/caches'
        ]*/
    );

    $router = $newContainer->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$containerConfiguration['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page Not Found 404'); //todo desing your custom error page
    };
};

include('route/default.php');
include('route/authentication.php');
include('route/user.php');


$app->run();
