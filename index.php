<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>E biblioteka</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="page.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
	<link href="styles.css" rel="stylesheet">
	<link href="styles1.css" rel="stylesheet">
	

</head>
<?php require 'menu.php'; ?>
<body>
<?php require 'slider.php'; ?>
<?php require 'loaddata.php'; ?>

<div class="container marketing" style="margin-top: -80px">
    <hr class="featurette-divider">

    <div id="content"></div>

    <hr class="featurette-divider">

    <span style="text-align: center" class="center">
    <div id='paginator'></div>
    </span>

</div><!-- /.container -->

</body>
<input type="hidden" name="page_count" id="page_count" />
</html>
