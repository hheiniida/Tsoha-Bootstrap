<?php

require '/app/models/muistettavat.php';

class MuistettavaController extends BaseController {

    public static function index() {

        $muistettava = Muistettavat::all();

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

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'kuvaus' => $params['kuvaus'],
            'pvm' => $params['pvm']
        );

        $muistettava = new Muistettavat($attributes);
        $errors = $muistettava->validate_nimi();

        if (count($errors) > 0) {
            //View::make('game/edit.html', array('errors' => $errors, 'attributes' => $attributes));
            echo 'Muokkaus on virheellinen';
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $muistettava->update();
            Redirect::to('/edit' . $muistettava->id, array('message' => 'Muistettavaa on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {

        $muistettava = new Muistettavat(array('id' => $id));

        $muistettava->destroy();

        Redirect::to('/edit', array('message' => 'Muistettava on poistettu onnistuneesti!'));
    }

    public static function store() {

        $params = $_POST;
        Kint::dump($params);
        //die();
        // Alustetaan uusi Muistettva-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'kuvaus' => $params['kuvaus'],
            'pvm' => $params['pvm']
        );
        $muistettava = new Muistettavat($attributes);
        $errors = $muistettava->errors();
        if (count($errors) == 0) {
            $muistettava->save();
            Redirect::to('/todo', array('message' => 'Muistettava on lisätty kirjastoosi!'));
            // ...
        } else {
            Redirect::to('/todo', array('message' => 'Nimessä oli virhe!'));
        }
    }

}
