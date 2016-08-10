<?php
/**
 * Frontcontroller to bootstrap essentials and return a response.
 */
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/../vendor/mos/anax"));
define("ANAX_APP_PATH", __DIR__ . "/..");

require __DIR__ . "/../vendor/autoload.php";

$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\App\CAnaxDefault($di);



/**
 * Sample function to integrate with a phpbb installation and lend some
 * information on the authorized user.
 */
call_user_func(function () use ($app) {
    $phpbb = new \Anax\AddOn\PHPBB\CInterface();
    $data = $phpbb->getSessionDetails(__DIR__ . "/forum/");
    $app->views->add("default/profile-phpbb", $data, "profile");
});



$app->loadRoutes();
$app->router->handle();
$app->theme->render();
