<?php

class Kupac {

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

    public function nov($ime, $email, $lozinka, $adresa) {
        $this->open_connection();
        $query = "INSERT INTO kupac (ime, email, lozinka, adresa) VALUES ('" . $ime . "', '" . $email . "', '" . $lozinka . "','" . $adresa . "')";

        if (!$this->query($query)) {
            !$this->close_connection();
            echo "Nastala je greska!";
        } else {
            !$this->close_connection();
            return true;
        }
    }

    public function uloguj($email, $lozinka) {

        $this->open_connection();
        $q = "SELECT id from kupac WHERE email='" . $email . "' AND lozinka='" . $lozinka . "'";

        // OVDE SMO TAKODJE TIME STO SMO STAVILI !=1 obezbedili da ne moze da se upadne u sistem ako haker kao lozinku unese (a' OR '1'='1)
        // Zato sto ce u tom slucaju upit vratiti vise od jednog reda pa nece otici u ELSE.
        // Medjutim ovo nije dovoljno jer ukoliko bi postojao samo admin u bazi, moglo bi da se lako upadne u sistem. Za to je koriscena fja: mysqli_real_escape_string

        if ((mysqli_num_rows($q = $this->query($q))) !=1 ) {
            $this->close_connection();
            return false;
        } else {
            $this->close_connection();
            $_SESSION['user'] = $email;
            $_SESSION['email'] = $email;
            return true;
        }
    }


    public function kupci($sort, $order, $numbero, $postranici) {

        $this->open_connection();

        if (!$r = $this->query("SELECT id, ime, adresa, email, nivo, pol, datum_registracije FROM Kupac ORDER BY " . $sort . " " . $order . " LIMIT " . $numbero . " , " . $postranici)) {
            $this->close_connection();
            return false;
        } else {
            $this->close_connection();
            return $r;
        }
    }

}

?>
