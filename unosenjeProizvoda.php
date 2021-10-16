<html>
<head>
    <?php
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <link href="styles.css" rel="stylesheet">
    <script src="js/jquery.validate.min.js"></script>
    <script>
        (function ($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function () {
                    $("#form").validate({
                        rules: {
                            naziv: {
                                required: true,
                                minlength: 2,
                                maxlength: 250
                            },
                            tip: {
                                required: true
                            },
                            dimenzije: {
                                required: true,
                                minlength: 2,
                                maxlength: 25
                            },
                            autor: {
                                required: true,
                                minlength: 2,
                                maxlength: 25
                            },
                            godina: {
                                required: true,
                                minlength: 2,
                                maxlength: 25
                            }
                        },
                        messages: {
                            naziv: {
                                required: "Ovo polje je obavezno!",
                                minlength: "Polje mora imati minimum 2 karaktera!",
                                maxlength: "Polje može imati maksimum 250 karaktera!"
                            },
                            tip: {
                                required: "Ovo polje je obavezno!"
                            },
                            dimenzije: {
                                required: "Ovo polje je obavezno!",
                                minlength: "Polje mora imati minimum 2 karaktera!",
                                maxlength: "Polje može imati maksimum 25 karaktera!"
                            },
                            autor: {
                                required: "Ovo polje je obavezno!",
                                minlength: "Polje mora imati minimum 2 karaktera!",
                                maxlength: "Polje može imati maksimum 25 karaktera!"
                            },
                            godina: {
                                required: "Ovo polje je obavezno!",
                                minlength: "Polje mora imati minimum 2 karaktera!",
                                maxlength: "Polje može imati maksimum 25 karaktera!"
                            }
                        },
                        submitHandler: function (form) {
                            form.submit();
                        }
                    });
                }
            }
            $(D).ready(function ($) {
                JQUERY4U.UTIL.setupFormValidation();
            });
        })(jQuery, window, document);
    </script>
</head>
<?php require 'menu.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">
    <?php

    if (isset($_GET['poruka'])) {
        $staPrikazati = $_GET['poruka'];
        if ($staPrikazati == "Uspešno ste dodali proizvod!") {
            echo "<h3><span style='color:green;'>" . $staPrikazati . "</span></h3>";
        } else {
            echo "<h3><span style='color:red;'>" . $staPrikazati . "</span></h3>";
        }
    } else {


        // poziv WS za TIPOVE

        $curlZaSB = curl_init('http://localhost/BookShop/tipovi.json');
        curl_setopt($curlZaSB, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlZaSB, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curlZaSB, CURLOPT_HTTPGET, true);
        $curl_odgovorSB = curl_exec($curlZaSB);
        curl_close($curlZaSB);
        $odgovorOdServisa = json_decode($curl_odgovorSB);


        ?>


        <form id="form" method="POST" action="unesiProizvod.php">

            <fieldset>

                <!-- Form Name -->
                <legend>Unošenje proizvoda</legend>

                <div class="fieldgroup">
                    <label for="naziv">Naziv: </label>
                    <input type="text" class="form-control input-md" name="naziv" id="naziv"> <br><br>
                </div>


                <div class="form-group">
                    <div class="fieldgroup">
                        <label for="dimenzije">Dimenzije: </label>
                        <input class="form-control input-md" type="text" name="dimenzije" id="dimenzije"> <br><br>
                    </div>
                </div>


                <div class="fieldgroup">
                    <label for="autor">Autor: </label>
                    <input class="form-control input-md" type="text" name="autor" id="autor"> <br><br>
                </div>

                <div class="fieldgroup">
                    <label for="godina">Godina izdanja: </label>
                    <input class="form-control input-md" type="text" name="godina" id="godina"> <br><br>
                </div>
                <br>

                <div class="fieldgroup">
                    <label for="url">URL fotografije: </label>
                    <input class="form-control input-md" type="text" name="url" id="url"> <br><br>
                </div>
                <br>

                <div class="fieldgroup">
                    <label for="cena">Cena: </label>
                    <input class="form-control input-md" type="text" name="cena" id="cena"> <br><br>
                </div>


                <!-- Select Basic -->
                <div class="fieldgroup">
                    <label for="cena">Tip: </label>
                    <select id="tip" name="tip" class="form-control">
                        <option value=''></option>
                        <?php

                        foreach ($odgovorOdServisa->tipovi as $tip) {
                            echo "<option value='$tip->idtip'>$tip->tip</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>

                <div class="fieldgroup">
                    <button type="submit" id="sacuvaj" name="sacuvaj" class="btn btn-primary">Unesi proizvod</button>
                </div>


            </fieldset>
        </form>

    <?php } ?>

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
