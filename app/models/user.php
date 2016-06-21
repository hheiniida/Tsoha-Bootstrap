<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends BaseModel {

    public $id, $nimi, $salasana;

    public static function find() {
        return 'id';
    }

    public function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Henkilo WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        
        if ($row) {
            
            // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            return new User(array(
                'id'=> $row['id'],
                'nimi'=> $row['nimi'],
                'salasana'=> $row['salasana']
            ));
                
        
        } else {
            // Käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }

}
