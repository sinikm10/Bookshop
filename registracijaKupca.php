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

         if(isset($_SESSION['email'])){

                            echo "Već ste registrovani!";

                        } else { ?>

                <form method="post" action="registrujKupca.php" enctype="multipart/form-data">

                    <label class="control-label">Ime:</label><br/> 
                    <input class='form-control' type="text" value="" required size='40' placeholder='Molimo unesite Vaše ime...' name="ime" /><br/> 

                    <label class="control-label">Prezime:</label><br/> 
                    <input class='form-control' type="text" value="" required size='40' placeholder='Molimo unesite Vaše prezime...' name="prezime" /><br/> 

                    <label class="control-label">Adresa:</label><br/> 
                    <input class='form-control' type="text" value="" required size='40' placeholder='Molimo unesite Vašu adresu...' name="adresa" /><br/> 

                    <label class="control-label">Email:</label><br/> 
                    <input class='form-control' type="email" size='40' value="" required placeholder='Molimo unesite Vašu email adresu...' name="email" /><br/> 

                    <label class="control-label">Lozinka:</label><br/> 
                    <input class='form-control' type="password" size='40' placeholder='Molimo unesite željenu lozinku...' value="" required name="lozinka" /><br/>

                    <input class='btn btn-success form-control' type="submit" name="dodaj" value="Registracija" />

                </form>
<?php } ?>

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
