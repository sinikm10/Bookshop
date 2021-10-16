<html>

<head>
    <?php require 'menu.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
	<link rel="stylesheet" type="text/css" href="styles1.css" />
	<link href="carousel.css" rel="stylesheet">
    <script src="https://www.google.com/jsapi"></script>
    <script>
        // Ucitava se API za vizuelizaciju
        google.load('visualization', '1.0', {'packages':['corechart']});
        // Šalje povratni poziv kada se ucita API
        google.setOnLoadCallback(crtajGrafik);
        // Funkcija šalje asinhrono JSON podatke, koje PHP fajl vizuelizacija.php generiše iz baze
        function crtajGrafik() {
            var jsonData = $.ajax({
                url: "http://localhost/COOLSHOP/vizuelizacija.json",
                dataType:"json",
                async: false
            }).responseText;

            var tip1 = $.ajax({
                url: "http://localhost/COOLSHOP/vizuelizacija.json?tip=1",
                dataType:"json",
                async: false
            }).responseText;

            var tip2 = $.ajax({
                url: "http://localhost/COOLSHOP/vizuelizacija.json?tip=2",
                dataType:"json",
                async: false
            }).responseText;

            var tip3 = $.ajax({
                url: "http://localhost/COOLSHOP/vizuelizacija.json?tip=3",
                dataType:"json",
                async: false
            }).responseText;
            // Kreira se tabela sa podacima na osnovu poslatih JSON podataka
            var data = new google.visualization.DataTable(jsonData);
            var data1 = new google.visualization.DataTable(tip1);
            var data2 = new google.visualization.DataTable(tip2);
            var data3 = new google.visualization.DataTable(tip3);

            var options = {'title':'VIZUELNI PRIKAZ CENA KNJIGA', titleTextStyle: {color: '#33a8ad', bold: true,fontSize: 20},
                'hAxis': {title: 'Cene su u RSD',  titleTextStyle: {color: '#33a8ad', bold: true,fontSize: 14}},
                'width':850,
                'height':500
            };
            // Instancira se grafikon i prosleduju mu se parametri, ukljucujuci i ID div-a gde ce
            // grafikon biti prikazan
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            //prikazi poruku za sve tipove
            function dogadjaj() {
                var selectedItem = chart.getSelection()[0];
                if(selectedItem) {
                    var proizvod = data.getValue(selectedItem.row, 0);
                    var cena = data.getValue(selectedItem.row, 1);
                    alert('Knjiga '+ proizvod +' ima cenu: '+ cena +' RSD ');
                }
            }
            //osluskuj da li ce korisnik da selektuje nesto, ako selektuje pozovi funkciju dogadjaj
            var listenerHandle = google.visualization.events.addListener(chart, 'select', dogadjaj);
            chart.draw(data, options);

            var dugmence = document.getElementById('dugmence');
            dugmence.onclick = function(event) {
                event.preventDefault();
                var izborTipa = document.forma.tip.selectedIndex;
                var izabranTip = document.forma.tip.options[izborTipa].value;
                if(izabranTip == '') {
                    chart.draw(data, options);
                    listenerHandle = google.visualization.events.addListener(chart, 'select', dogadjaj);
                };
                if(izabranTip == '1') {
                    chart.draw(data1, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranTip == '2') {
                    chart.draw(data2, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
                if(izabranTip == '3') {
                    chart.draw(data3, options);
                    google.visualization.events.removeListener(listenerHandle);
                };
            }
        }
    </script>
</head>
<body>

<div class="container marketing">
    <hr class="featurette-divider">

    <?php
    $urlTipovi = 'http://localhost/COOLSHOP/tipovi.json';
    $curlZahtev = curl_init($urlTipovi);
    curl_setopt($curlZahtev, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlZahtev, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curlZahtev, CURLOPT_HTTPGET, true);
    $tipovi = curl_exec($curlZahtev);
    curl_close($curlZahtev);
    $json_tipovi = json_decode($tipovi);
    ?>
	<div id="" class="row">
	<div class = "col-md-3"></div>
    <div class="col-md-6">
        <form name="forma" method="GET">
            Prikaz vizuelizacije za žanr:
            <select id="tip" name="tip" class="form-control">
                <option value="" selected="selected">Svi žanrovi</option>
                <?php
                foreach($json_tipovi->tipovi as $tip) {
                    echo "<option value='$tip->idtip'>$tip->tip</option>";
                }
                ?>
            </select>
			<br>
            <button name="dugmence" id="dugmence" class="btn btn-success" style="width:200px;margin-right:150px; float:right; height:30px;">Prikaži</button>			
        </form>
    </div>
	</div>
    <br>
    <div id="" class="row">
    <div id="chart_div" style="text-align: center; margin-left: 220px"></div>
    </div>
</div>
    <hr class="featurette-divider">
</div><!-- /.container -->

</body>
</html>
