<?php
session_start();
if($_SESSION['email'] != "admin@gmail.com") {
    header("Location: index.php");
}
$idproizvoda = $_GET['idproizvod'];
$url = 'http://localhost/BookShop/proizvodi/'. $idproizvoda;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

$curl_odgovor = curl_exec($curl);
curl_close($curl);
$json_objekat = json_decode($curl_odgovor);

if(isset($json_objekat)) {
    header("Location: proizvodi_admin.php?poruka=$json_objekat->poruka");
}
?>