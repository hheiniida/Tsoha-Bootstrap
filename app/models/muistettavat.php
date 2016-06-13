<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Muistettavat extends BaseModel {
    public $id, $henkilo_id, $luokka_id, $nimi, $prioriteetti,
            $kuvaus, $pvm;
    public function __construct($muista) {
        $this->id = $muista['id'];
        $this->henkilo_id = $muista['henkilo_id'];
        $this->luokka_id = $muista['luokka_id'];
        $this->nimi = $muista['nimi'];
        $this->prioriteetti = $muista['prioriteetti'];
        $this->kuvaus = $muista['kuvaus'];
        $this->pvm = $muista['pvm'];
    }
//    public function __construct($attributes) {
//        parent::__construct($attributes);
//    }
    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Muistettava');
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
    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Muistettava (nimi, prioriteetti, kuvaus, pvm) VALUES (:nimi, :prioriteetti, :kuvaus, :pvm) RETURNING id');
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
