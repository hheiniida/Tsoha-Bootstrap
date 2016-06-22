<?php

class Muistettavat extends BaseModel {

    public $id, $henkilo_id, $luokka_id,$luokka_nimi, $nimi, $prioriteetti,
            $kuvaus, $pvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Muistettava order by prioriteetti asc');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $items = array();
        
        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $items[] = new Muistettavat(array(
                'id' => $row['id'],
                'henkilo_id' => $row['henkilo_id'],
                'luokka_id' => $row['luokka_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'kuvaus' => $row['kuvaus'],
                'pvm' => $row['pvm']
            ));
        }
        return $items;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Muistettava (luokka_id, nimi, prioriteetti, kuvaus, pvm) VALUES (:luokka_id, :nimi, :prioriteetti, :kuvaus, :pvm) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('luokka_id'=> $this->luokka_id, 'nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'kuvaus' => $this->kuvaus, 'pvm' => $this->pvm));
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
            return new Muistettavat(array(
                'id' => $row['id'],
                'henkilo_id' => $row['henkilo_id'],
                'luokka_id' => $row['luokka_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'kuvaus' => $row['kuvaus'],
                'pvm' => $row['pvm']
            ));
        }

        return null;
    }

    public static function delete($id) {

        $query = DB::connection()->prepare('DELETE FROM Muistettava WHERE id = :id');
        $query->execute(array('id' => $id));
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Muistettava SET id=:id, nimi=:nimi, luokka_id=:luokka_id, prioriteetti=:prioriteetti, kuvaus=:kuvaus, pvm=:pvm WHERE id = :id');
        $query->execute(array('id' => $id, 'nimi'=> $this->nimi,'luokka_id'=> $this->luokka_id, 'prioriteetti'=> $this->prioriteetti, 'kuvaus'=> $this->kuvaus, 'pvm'=> $this->pvm));
        $row = $query->fetch();

        Kint::dump($row);
    }

}
