<?php
include "proizvodi.php";
$proizvod = new Proizvod();
if(isset($_GET["str"])){
    $pretrazi = $_GET["str"];
    $proizvodi = $proizvod->dajPretrazeneProizvode($pretrazi);
}
else {
    //vrati sve proizvode ako je str = ''
    $proizvodi = $proizvod->dajProizvode();
}

if(isset($_SESSION["izabranaValuta"])) {
    $ceneEUR = $proizvod->vratiCeneUEur($_SESSION["izabranaValuta"]);
    $val = $_SESSION["izabranaValuta"];
    echo "<table class='tabelaMeni' width='500' cellpadding='5' cellspacing='3'> 
	<col style='width:60%'>
	<col style='width:40%'>
	<th colspan='2'> </th>
	<tr> <td><b>Naziv</b></td> <td><b>Cena(".$val.")</b></td> </tr>";
    $broj = 0;
    foreach ($proizvodi as $pr) {

        echo "<tr/><td>" . $pr->naziv . "</td><td> " . $ceneEUR[$broj]. "</td> </tr>";
        $broj = $broj+1;
    }
    echo "</table>";
}else{
    echo "<table class='tabelaMeni' width='500' cellpadding='5' cellspacing='3'> 
	<col style='width:60%'>
	<col style='width:40%'>
	<th colspan='2'> </th>
	<tr> <td><b>Naziv</b></td> <td><b>Cena(RSD)</b></td> </tr>";
    foreach ($proizvodi as $pr) {
        echo "<tr/><td>" . $pr->naziv . "</td><td> " . $pr->cena . "</td> </tr>";
    }
    echo "</table>";
}
?>
