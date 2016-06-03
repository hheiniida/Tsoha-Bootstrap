<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login.html', function() {
    HelloWorldController::login();
});
$routes->get('/edit.html', function() {
    HelloWorldController::edit();
});
