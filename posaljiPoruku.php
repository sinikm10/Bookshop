<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>Cool Shop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor_holder.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
	<link href="styles.css" rel="stylesheet">

</head>
<?php require 'menu.php'; ?>
<body>

<div class="container marketing" style="margin-top: -80px">
    <hr class="featurette-divider">

    <div id="content">
           <hr class="featurette-divider">

        <?php


$headers = 'From: '. $_REQUEST['email'] . "\r\n" .
    'Reply-To: ' . $_REQUEST['email']. "\r\n" .
    'X-Mailer: PHP/' . phpversion();


    $mail_sent = @mail('vukasin.grahovac@gmail.com', $_REQUEST['subject'], $_REQUEST['message'], $headers);
        echo $mail_sent ? "Mail sent" : "Mail failed";

    

?>

    </div>

    <hr class="featurette-divider">

</div><!-- /.container -->

</body>

</html>
