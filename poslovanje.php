<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="sr" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="poslovanje.css" rel="stylesheet">    
    
    <script src="js/bootstrap.min.js"></script>
    <style>

        .red{
            color:red;
            }
        .form-area{
            background-color: #FAFAFA;
            padding: 10px 40px 60px;
            margin: 10px 0px 60px;
            border: 1px solid GREY;
        }
        
    </style>
    
<?php require 'menu.php'; ?>
<body>
<?php require 'slider.php'; ?>
<div class="container marketing">
<div class="container">
<!-- <hr class="featurette-divider"> -->
<section>

<article>
<div id = "mar">
<h2 id = "mar1"><b>BookShop marketing</b></h2>
<hr>
    <button type="button" id = "AJ" onclick="loadDoc()">Detaljnije...</button>
<script>
       function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("AJ").innerHTML =
           this.responseText;
      }
     };
      xhttp.open("GET", "marketing1.txt", true);
      xhttp.send();
      }
    </script>
</div>
<hr id = "no">
</article>

<article>
<div id = "mar">
<h2 id = "mar1"><b>Sakupljajte bodove i ostvarite dodatne popuste!</b>
</h2>
<hr>
<button type="button" id = "AJ1" onclick="loadDoc1()">Detaljnije...</button>
<script>
       function loadDoc1() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("AJ1").innerHTML =
           this.responseText;
      }
     };
      xhttp.open("GET", "bodovi1.txt", true);
      xhttp.send();
      }
    </script>
</div>

<hr id = "no">
</article>

<article>
<div id = "mar">
<h2 id = "mar1"><b>Dostava</b></h2>
<hr>
<button type="button" id = "AJ2" onclick="loadDoc2()">Detaljnije...</button>
<script>
       function loadDoc2() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("AJ2").innerHTML =
           this.responseText;
      }
     };
      xhttp.open("GET", "Dostava1.txt", true);
      xhttp.send();
      }
    </script>
</div>
</article>

</section>

</div>
</div>
<!-- <hr class="featurette-divider"> -->

</body>
</html>
