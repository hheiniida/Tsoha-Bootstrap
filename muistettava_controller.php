<?php

class MuistettavaController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $muistettava = Muistettavat::all();
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('home.html', array('muistettava' => $muistettava));
    }

    public static function todo() {
        // Testaa koodiasi täällä
        //echo 'Hello World!';
        View::make('index.html');
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa

        $params = $_POST;

        Kint::dump($params);
        //die();
        // Alustetaan uusi Muistettva-luokan olion käyttäjän syöttämillä arvoilla
        $muistettava = new Muistettavat(array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'kuvaus' => $params['kuvaus'],
            'pvm' => $params['pvm']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $muistettava->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/todo', array('message' => 'Muisettava on lisätty kirjastoosi!'));
    }

}
