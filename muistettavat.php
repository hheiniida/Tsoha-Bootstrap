<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Muistettavat extends BaseModel {

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Muistettavat');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $muistettava = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $muistettava[] = new Muistettavat(array(
                'id' => $row['id'],
                'henkilo_id' => $row['henkilo_id'],
                'luokka_id' => $row['luokka_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'kuvaus' => $row['kuvaus'],
                'pvm' => $row['pvm']
            ));
        }

        return $muistettava;
    }

    public static function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Muistettavat (nimi, prioriteetti, kuvaus, pvm) VALUES (:nimi, :prioriteetti, :kuvaus, :pvm) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'kuvaus' => $this->kuvaus, 'pvm' => $this->pvm));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Muistettava WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $muistettava = new Muistettavat(array(
                'id' => $row['id'],
                'henkilo_id' => $row['henkilo_id'],
                'luokka_id' => $row['luokka_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'kuvaus' => $row['kuvaus'],
                'pvm' => $row['pvmpublisher']
            ));

            return $muistettava;
        }

        return null;
    }

}
