<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = User::authenticate($params['nimi'], $params['salasana']);
        if (!$user) {
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
        } else {
            $_SESSION['nimi'] = $user->id;
            Redirect::to('/todo', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

}
