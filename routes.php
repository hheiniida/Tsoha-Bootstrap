<?php

$routes->get('/', function() {
    MuistettavaController::index();
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
$routes->post('/muista', function() {
    MuistettavaController::store();
});
$routes->get('/muistettava/:id', function() {
    MuistettavaController::store();
});
