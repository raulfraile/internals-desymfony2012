<?php

// if you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array(
        '127.0.0.1',
        '::1',
    ))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

use Symfony\Component\HttpFoundation\Request;


$kernel = new AppKernel('dev', true);



require_once $kernel->getRootDir() . '/../vendor/ladybug/lib/Ladybug/Autoloader.php';
Ladybug\Autoloader::register();
ladybug_set('object.max_nesting_level', 4);

echo '<h2>Autoload:</h2>';
ld($loader);
echo '<blockquote>';
echo '$loader->findFile(\'Symfony\\Component\\HttpFoundation\\Request\');<br/>';
echo $loader->findFile('Symfony\\Component\\HttpFoundation\\Request');
echo '</blockquote>';

echo '<h2>AppKernel:</h2>';
ld($kernel);

//ob_flush();
$kernel->loadClassCache();

$request = Request::createFromGlobals();

echo '<hr/>';
echo '<h2>HTTP Request:</h2>';
echo '<blockquote>' . str_replace("\n", '<br/>', $request) . '</blockquote>';









echo '<h2>Objeto Request:</h2>';
ld($request);

$response = $kernel->handle($request);

echo '<h2>Objeto Response:</h2>';
ld($response);



echo '<h2>HTTP Response:</h2>';
echo '<blockquote>' . str_replace("\n", '<br/>', htmlentities($response)) . '</blockquote>';

echo '<h2>Contenido:</h2>';



$response->send();
//echo str_replace("\n", '<br/>', $response);
