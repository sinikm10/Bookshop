<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>Cool Shop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
	<link href="styles.css" rel="stylesheet">
</head>
<?php require 'menu.php'; ?>
<?php require 'kupac.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">

            <?php
            // Ovde smo preko funkcije mysqli_real_escape_string  obezbedili da ne moze da se
            // upadne u sistem ako haker kao lozinku unese (a' OR '1'='1)

            $kupac = new Kupac();
            $kupac->open_connection();
            $email = mysqli_real_escape_string($kupac->connection, $_POST['email']);
            $lozinka = mysqli_real_escape_string($kupac->connection, $_POST['lozinka']);

            if($kupac->uloguj($email, $lozinka)){
                            echo "<script>alert('Uspešno ste se prijavili!');
                                  window.location.href='index.php';
                                  </script>";
                        } else {
                             echo "Uneti podaci nisu ispravni. Pokušajte ponovo: " ."<a href = 'logovanje.php'>ovde</a>".".";
                        }

            ?>
    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>

