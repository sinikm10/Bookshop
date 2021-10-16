<?php

class Proizvod {

    public $connection;

    public $naziv;
    public $cena;


    function __construct($naziv='',$cena=0){
        $this->naziv=$naziv;
        $this->cena=$cena;
    }
    function getNaziv(){
        return $this->naziv;
    }
    function getCena(){
        return $this->cena;
    }
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

    public function vratiCeneUEur($valuta) {
        $proizvodi = $this->dajProizvode();
        $cene = array();
        foreach ($proizvodi as $pr){
            $cene[] = $pr->cena;
        }
        $konvertovaneCene = array();
        foreach ($cene as $cen){
            $iznos = $cen;
            $izvalute = 'RSD';
            $url = '/'.$izvalute.'/'.$valuta.'/'.$iznos;
            $curl = curl_init($url);
            //za FON-ovu mrezu treba podesiti proksi. Za ostale mreze linije za proksi treba da budu pod komentarom
            //curl_setopt($curl, CURLOPT_PROXY, 'proxy.rcub.bg.ac.rs:8080');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            $curl_odgovor = curl_exec($curl);
            curl_close($curl);
            $parsiran_json = json_decode ($curl_odgovor);
            $konvertovaneCene[] = $parsiran_json->result->value;
        }
        return $konvertovaneCene;

    }

     function dajPretrazeneProizvode($pretraga = 1) {

        $url = 'http://localhost/BookShop/proizvodi.json?str='.$pretraga;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);

        $json_objekat = json_decode($curl_odgovor);

        return $json_objekat->proizvodi;

    }

    public function dajProizvode($start_row = '') {

        $url = 'http://localhost/BookShop/proizvodi.json?start='.$start_row;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);

        $json_objekat = json_decode($curl_odgovor);

        return $json_objekat->proizvodi;

    }

    public function add($title, $description, $picture, $category) {

        $this->open();

        if (!$this->query("INSERT INTO items (title, description, picture, author, category) VALUES ('" . $title . "', '" . $description . "', '" . $item . "', '" . $_SESSION['id'] . "', '" . $category . "')")) {
            $this->close();
            return "INSERT INTO items (title, description, picture, author) VALUES ('" . $title . "', '" . $description . "', '" . $item . "', '" . $_SESSION['id'] . "')";
        } else {
            $this->close();
            return true;
        }
    }


    public function get_items_category($id) {

        $this->open();

        if (!$r = $this->query("SELECT id, title, picture, description, category, author, date_entered from items WHERE category like '" . $id . "'")) {
            $this->close();
            return false;
        } else {
            $this->close();
            return $r;
        }
    }

    public function category_items($category) {

        $this->open();

        if (!$r = $this->query("SELECT id, title, picture, description, category, author, date_entered from items WHERE category = ".$category)) {
            $this->close();
            return false;
        } else {
            $this->close();
            return $r;
        }
    }

    public function return_item($id) {

        $this->open();

        if (!$r = $this->query("SELECT id, title, description, picture, picture, author, date_entered from items where id = " . $id)) {
            $this->close();
            return false;
        } else {
            $this->close();
            return mysqli_fetch_object($r);
        }
    }

    public function count() {

        $this->open();
        $broj_item = mysqli_num_rows($q = $this->query("SELECT * from items"));
        $this->close();
        return $broj_item;
    }

    public function delete($id) {

        $this->open();
        $r = $this->query("DELETE from items WHERE id = " . $id);
        $this->close();
        return $r;
    }



    public function edit($title, $description, $picture, $category, $id) {

        $this->open();
        $sql = "UPDATE items SET title='" . $title . "', description='" . $description . "', picture='" . $picture . "', category='" . $category . "' WHERE id = " . $id;
        if (!$this->query($sql)) {
            $this->close();
            echo $sql;
            return false;
        } else {
            $this->close();
            return 1;
        }
    }

}
