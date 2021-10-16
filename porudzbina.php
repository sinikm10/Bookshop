<?php

class Porudzbina {

    public $connection;

    public function open_connection() {
        $this->connection= new mysqli('localhost', 'root', '', 'coolshop');
        if (!$this->connection)
            return false;
        return true;
    }

    public function close_connection() {
        $this->connection->close();
    }
    public function query($query) {
        return $this->connection->query($query);
    }



    public function dodaj($proizvod) {

        $this->open_connection();
        $q = "INSERT INTO porudzbine (kupac, proizvod) VALUES ('" . $_SESSION['email'] . "', '" . $proizvod . "')";

        if (!$this->query($q)) {
            $this->close_connection();
            return $q;
        } else {
            $this->close_connection();
            return true;
        }
    }


    function dajPorudzbine($email = '') {

        if($email == '') $url = 'http://localhost/BookShop/sve_porudzbine';
        else  $url = 'http://localhost/BookShop/moje_porudzbine/'.$email;
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);

        $json_objekat = json_decode($curl_odgovor);

        return $json_objekat;

    }

   
    public function daj($id = '') {

        $this->open_connection();

        $q = "SELECT * from porudzbine p JOIN kupci k ON p.kupac = k.email ";

        if(isset($id) && $id != '') { $q .= " where id = " . $id; }

        if (!$r = $this->query($q)) {
            $this->close_connection();
            return false;
        } else {
            $this->close_connection();
            return mysqli_fetch_object($r);
        }
    }


    public function obrisi($id) {
        $this->open_connection();
        $r = $this->query("DELETE from porudzbine WHERE id = " . $id);
        $this->close_connection();
        return $r;
    }


}
