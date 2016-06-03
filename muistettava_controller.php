<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MuistettavaController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $muistettava = Muistettavat::all();
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('muistettava/index.html', array('muistettava' => $muistettava));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $muistettava = new Muistettavat(array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'kuvaus' => $params['kuvaus'],
            'pvm' => $params['pvm']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $muistettava->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/muistettava/' . $muistettava->id, array('message' => 'Muisettava on lisätty kirjastoosi!'));
    }

}
