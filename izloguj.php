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
<?php require 'kupac.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">

            <?php


                        if(session_destroy()){
                            echo "<script>alert('Uspešno ste se odjavili!');
                                  window.location.href='index.php';
                                  </script>";
                        } else {
                             echo "Nastala je greška!";
                        }

            ?> 

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
