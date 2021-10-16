<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <style>

        .red {
            color: red;
        }

        .form-area {
            background-color: #33a8ad;
            padding: 10px 40px 60px;
            margin: 10px 0px 60px;
            border: 1px solid GREY;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANEoZ8RYqsd3TLyJX6CS1hcADO4wewpAg&sensor=true"></script>
    <script>
        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(44.805543, 20.4983),
                zoom: 14
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            var url = "http://localhost/BookShop/lokacije.json";
            var myloc = new Array();
            $.getJSON(url, function (lokacije) {
                $.each(lokacije.markeri, function (i, marker) {
                    kreirajMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(marker.latitude, marker.longitude),
                        map: map,
                        icon: 'slike/logoBook.png',
                        title: marker.naziv
                    });
                })
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
        #map-canvas {
            width: 100%;
            margin-top: 10px;
            height: 550px
        }
    </style>
    <script>

        $(document).ready(function () {
            $(".poljeGreska").hide();
            //ime

            $("#name").blur(function () {
                if (this.value == "") {
                    $(this).css("border", "1px solid red");
                    $("#greskaIme").show();
                }
            });
            $("#email").blur(function () {
                if (this.value == "") {
                    $(this).css("border", "1px solid red");
                    $("#greskaEmail").show();
                }
            });
            $("#mobile").blur(function () {
                if (this.value == "") {
                    $(this).css("border", "1px solid red");
                    $("#greskaMobile").show();
                }
            });
            $("#subject").blur(function () {
                if (this.value == "") {
                    $(this).css("border", "1px solid red");
                    $("#greskaSubject").show();
                }
            });
            $("#message").blur(function () {
                if (this.value == "") {
                    $(this).css("border", "1px solid red");
                    $("#greskaMessage").show();
                }
            });

        });


    </script>
</head>
<?php require 'menu.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">
    <div class="container">
        <div class="col-md-5">
            <div class="form-area">
                <form role="form" method="post" action="posaljiPoruku.php">
                    <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Imate neke nedoumice?<br>Pišite nam!</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Vaše ime" required>
                    </div>
                    <div id="greskaIme" class="poljeGreska">Upozorenje:Niste popunili ime!</div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div id="greskaEmail" class="poljeGreska">Upozorenje:Niste popunili email!</div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Broj telefona"
                               required>
                    </div>
                    <div id="greskaMobile" class="poljeGreska">Upozorenje:Niste popunili telefon!</div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Naslov poruke"
                               required>
                    </div>
                    <div id="greskaSubject" class="poljeGreska">Upozorenje:Niste popunili naslov poruke!</div>
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Poruka"
                                  maxlength="140" rows="7"></textarea>

                    </div>
                    <div id="greskaMessage" class="poljeGreska">Upozorenje:Niste popunili poruku!</div>

                    <input type="submit" id="submit" value="Pošalji poruku" name="submit" class="btn btn-primary pull-right">
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div id="map-canvas" class="col-md-5"></div>
        </div>


    </div>

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
