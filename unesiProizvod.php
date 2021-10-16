<?php
    $proizvod;
    if(isset($_POST['naziv']) && isset($_POST['tip']) && isset($_POST['dimenzije']) && isset($_POST['autor']) && isset($_POST['godina']) && isset($_POST['cena'])) {
        $proizvod = '{"naziv": "'. $_POST['naziv'] .'",
                      "idtip": "'. $_POST['tip'] .'",
                      "dimenzije":"'. $_POST['dimenzije'] .'",
                      "autor":"'. $_POST['autor'] .'",
                      "godina":"'. $_POST['godina'] .'",
                      "url":"'. $_POST['url'] .'",
                      "cena":"'. $_POST['cena'] .'"
                    }';    
    } 
    else {
        $proizvod = '{"Greška": "Niste uneli sve podatke!"}';
    }
    
    $url = 'http://localhost/BookShop/proizvodi';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $proizvod);
    
    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);

    if(isset($json_objekat)) {
        header("Location: unosenjeProizvoda.php?poruka=$json_objekat->poruka");
    }
?>