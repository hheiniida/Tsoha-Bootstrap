<?php

$routes->get('/', function() {
    MuistettavaController::index();
});

$routes->get('/todo', function() {
    MuistettavaController::todo();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
$routes->get('/edit', function() {
    HelloWorldController::edit();
});
$routes->post('/muista', function() {
    MuistettavaController::store();
});
$routes->get('/muistettava/:id', function() {
    MuistettavaController::store();
});
$routes->get('/edit', function($id) {
    // Pelin muokkauslomakkeen esittäminen
    MuistettavaController::edit($id);
});
$routes->post('/edit', function($id) {
    // Pelin muokkaaminen
    MuistettavaController::update($id);
});

$routes->post('/edit', function($id) {
    // Pelin poisto
    MuistettavaController::destroy($id);
});
