<?php

use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
//    header('HTTP/1.0 403 Forbidden');
//    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}
/* handle fatal errors - this is probably a hack. */
register_shutdown_function(function(){
    $error = error_get_last();
    if($error !== NULL){
        $info = "[SHUTDOWN] file:".$error['file']." | ln:".$error['line']." | msg:".$error['message'] ."\n\n";
        $email_message = $info;
//        $email_message .= '$_SESSION dump: '."\n".print_r($_SESSION, true)."\n\n";
        $email_message .= '$_GET dump: '."\n".print_r($_GET, true)."\n\n";
        $email_message .= '$_POST dump: '."\n".print_r($_POST, true)."\n\n";
        $email_message .= '$_SERVER dump: '."\n".print_r($_SERVER, true)."\n\n";

        echo( $email_message);
//        header('location:/error.html');
        exit;
    }
});

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
