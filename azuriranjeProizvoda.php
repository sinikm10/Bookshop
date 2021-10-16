<html>
<head>
<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
if($_SESSION['email'] != "admin@gmail.com") {

    header("Location: index.php");
}
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>Cool Shop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />

</head>
<?php require 'menu.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">
                 <?php

                        if(isset($_GET['poruka'])) {
                            $staPrikazati = $_GET['poruka'];
                            if($staPrikazati == "Uspešno ste izmenili proizvod!") {
                                echo "<h3><span style='color:green;'>". $staPrikazati ."</span></h3>";
                            }
                            else {
                                echo "<h3><span style='color:red;'>". $staPrikazati ."</span></h3>";
                            }
                        } else {


                        // poziv WS za detalje o proizvodu

                        $idproizvoda = $_GET['idproizvod'];
                        $url = 'http://localhost/COOLSHOP/daj_proizvod/'. $idproizvoda;

                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                        curl_setopt($curl, CURLOPT_HTTPGET, true);
                        $curl_odgovor = curl_exec($curl);
                        curl_close($curl);
                        $proizvod = json_decode($curl_odgovor);

                        // poziv WS za TIPOVE

                                    $curlZaSB = curl_init('http://localhost/COOLSHOP/tipovi.json');
                                    curl_setopt($curlZaSB, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($curlZaSB, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                                    curl_setopt($curlZaSB, CURLOPT_HTTPGET, true);
                                    $curl_odgovorSB = curl_exec($curlZaSB);
                                    curl_close($curlZaSB);
                                    $odgovorOdServisa = json_decode($curl_odgovorSB);


                    ?>
                    <img src="http://localhost/COOLSHOP/<?php echo $proizvod->url; ?>" style="float:left;width:150px;margin-right:10px;">


                    <form id="form" method="POST" action="azurirajProizvod.php?idproizvod=<?php echo "$proizvod->idproizvod";?>">

                    <fieldset>

                    <!-- Form Name -->
                    <legend>Azuriranje proizvoda</legend>

                        <div class="fieldgroup">
                            <label for="naziv">Naziv: </label>
                            <input type="text"  class="form-control input-md"  name="naziv" id="naziv" value="<?php echo "$proizvod->naziv";?>"> <br><br>
                        </div>


<div class="form-group">
                        <div class="fieldgroup">
                            <label for="dimenzije">Dimenzije: </label>
                            <input  class="form-control input-md" type="text" name="dimenzije" id="dimenzije" value="<?php echo "$proizvod->dimenzije";?>"> <br><br>
                        </div>
</div>


                        <div class="fieldgroup">
                            <label for="autor">Autor: </label>
                            <input  class="form-control input-md" type="text" name="autor" id="autor" value="<?php echo "$proizvod->autor";?>"> <br><br>
                        </div>

                        <div class="fieldgroup">
                            <label for="godina">Godina izdanja: </label>
                            <input  class="form-control input-md" type="text" name="godina" id="godina" value="<?php echo "$proizvod->godina";?>"> <br><br>
                        </div> <br>

                        <div class="fieldgroup">
                            <label for="url">URL fotografije: </label>
                            <input  class="form-control input-md" type="text" name="url" id="url" value="<?php echo "$proizvod->url";?>"> <br><br>
                        </div> <br>

                        <div class="fieldgroup">
                            <label for="cena">Cena: </label>
                            <input  class="form-control input-md" type="text" name="cena" id="cena" value="<?php echo "$proizvod->cena";?>"> <br><br>
                        </div>


                        <!-- Select Basic -->
                        <div class="fieldgroup">
                            <label for="cena">Tip: </label>
                            <select id="tip" name="tip" class="form-control">
                                <option value=''></option>
                                <?php

                                    foreach($odgovorOdServisa->tipovi as $tip) {
                                        echo "<option value='$tip->idtip' ";
                                        if($proizvod->idtip == $tip->idtip) {
                                            echo "selected";
                                        }
                                        echo ">$tip->tip</option>";
                                    }
                                ?>
                            </select>
                          </div>
                          <br>

<div class="fieldgroup">
    <button type="submit" id="sacuvaj" name="sacuvaj" class="btn btn-primary">Sačuvaj izmene</button>
  </div>



                        </fieldset>
                    </form>

<?php } ?>

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
