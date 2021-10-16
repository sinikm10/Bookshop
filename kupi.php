<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
	<link href="styles.css" rel="stylesheet">
</head>
<?php require 'menu.php'; ?>
<body>

<div class="container marketing">
    <hr class="featurette-divider">
    <?php
        if(!isset($_SESSION['email'])){
             echo "Morate biti " ."<a href = 'registracijaKupca.php'>registrovani</a>". " i " ."<a href = 'logovanje.php'>ulogovani</a>". ".";
        }
		else{ 
                require 'porudzbina.php'; 
              	$porudzbina = new Porudzbina();
                $w = $porudzbina->dodaj($_GET['id']);
                if( $w === true) {
                    echo "Uspešno ste poručili! Za upravljanje porudžbinama kliknite " ."<a href = 'mojePorudzbine.php'>ovde</a>". ".";
                } 
				else {
               		echo 'Neuspela kupovina!'.$w;
                }  
			} 
    ?>
    <hr class="featurette-divider">
</div><!-- /.container -->

</body>
</html>
