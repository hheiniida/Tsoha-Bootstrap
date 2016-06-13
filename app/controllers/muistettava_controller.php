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

    public static function edit($id) {
        $muistettava = Muistettavat::find($id);
        View::make('edit', array('attributes' => $muistettava));
    }

    // Pelin muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'kuvaus' => $params['kuvaus'],
            'pvm' => $params['pvm']
        );
        // Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
        $muistettava = new Muistettavat($attributes);
        $errors = $muistettava->errors();
        if (count($errors) > 0) {
            View::make('/edit', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $muistettava->update();
            Redirect::to('/edit' . $muistettava->id, array('message' => 'Muistettavaa on muokattu onnistuneesti!'));
        }
    }

    // Pelin poistaminen
    public static function destroy($id) {
        // Alustetaan Game-olio annetulla id:llä
        $muistettava = new Muistettavat(array('id' => $id));
        // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $muistettava->destroy();
        // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/edit', array('message' => 'Peli on poistettu onnistuneesti!'));
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
        if ($params['nimi'] != '' && strlen($params['nimi']) >= 3) {
            $nimi->save();
            Redirect::to('/todo', array('message' => 'Muistettava on lisätty kirjastoosi!'));
            // ...
        } else {
            Redirect::to('/todo', array('message' => 'Nimessä oli virhe!'));
        }
    }

}
