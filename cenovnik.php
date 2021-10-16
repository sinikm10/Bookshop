<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/ajax.js"></script>
    <link href="carousel.css" rel="stylesheet">
    <script type="text/javascript" src="page.js"></script>
    <script type="text/javascript" src="scripts/ajax.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="Cenovnik.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                pronadji(this.value);
            });

        });
    </script>
</head>
<?php

require 'menu.php'; ?>
<body>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valuta = $_POST["valuta"];
    echo $valuta;
    if ($valuta == 'EUR') {
        $_SESSION["izabranaValuta"] = 'EUR';
        header('Location: cenovnik.php');
    }
    if ($valuta == "RSD") {
        $_SESSION["izabranaValuta"] = 'RSD';
        header('Location: cenovnik.php');
    }
    if ($valuta == "USD") {
        $_SESSION["izabranaValuta"] = 'USD';
        header('Location: cenovnik.php');
    }
}
?>
<?php require 'slider.php'; ?>
<div class = "col-md-2"></div>
<div id = 'pretraga' class = "col-md-8">
        <h1>Cenovnik</h1>
        <br/>
        <label for='searchBox'>Pretrazi po nazivu </label>
        <br/>
        <input type='text' name='searchBox' id='search' size='20'/><br/>
        <div id="konvertuj">

            <form method="post">
                <input type = "submit" id = "dane" value="Konvertuj u valutu: "/>
                <select id="tip" name="valuta">
                    <option value="RSD" selected="selected">RSD</option>
                    <option value="EUR">EUR</option>
                    <option value="USD">USD</option>
                </select>

            </form>
        </div>
    </div>
	<div class = "col-md-3"></div>
<div id="glavnoMeni">
    <br />
    <div id="menu">
        <?php include "pretraga.php";
        ?>
    </div>

</div>

</body>
</html>
