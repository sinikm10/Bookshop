<!DOCTYPE html>
<html>
<head>
    <title>Vizuelizacija</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
	<link href="styles.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <script>
        google.load('visualization', '1.0', {'packages':['corechart']});  
        google.setOnLoadCallback(crtajGrafik);

        function crtajGrafik() {
            var jsonData = $.ajax({
                url: "http://localhost/BookShop/vizuelizacija.json",
                dataType:"json",
                async: false
            }).responseText;  

            var tip1 = $.ajax({
                url: "http://localhost/BookShop/vizuelizacija.json?tip=1",
                dataType:"json",
                async: false
            }).responseText;  

            var tip2 = $.ajax({
                url: "http://localhost/BookShop/vizuelizacija.json?tip=2",
                dataType:"json",
                async: false
            }).responseText;

            var tip3 = $.ajax({
                url: "http://localhost/BookShop/vizuelizacija.json?tip=3",
                dataType:"json",
                async: false
            }).responseText;  

            var data = new google.visualization.DataTable(jsonData);
            var data1 = new google.visualization.DataTable(tip1);
            var data2 = new google.visualization.DataTable(tip2);
            var data3 = new google.visualization.DataTable(tip3);

            var options = {'title':'VIZUELNI PRIKAZ CENA PROIZVODA',
                           'hAxis': {title: 'Cene su u RSD',  titleTextStyle: {color: 'red',bold: true,fontSize: 14}},
                           'width':850,
                           'height':500
                          };
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            
            function dogadjaj() {                  
                var selectedItem = chart.getSelection()[0];
                if(selectedItem) {
                    var proizvod = data.getValue(selectedItem.row, 0);
                    var cena = data.getValue(selectedItem.row, 1);                                             
                    alert('Proizvod '+ proizvod +' ima cenu: '+ cena +' RSD ');
                }
            }
           
            var listenerHandle = google.visualization.events.addListener(chart, 'select', dogadjaj);             
            chart.draw(data, options);

            var dugmence = document.getElementById('dugmence');
            dugmence.onclick = function() {
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
  	<header><br><br><br><br>Miševi</header> 
    
    <nav>
      	<ul>
            <li><a href="index.php">Početna</a></li>
            <li><a href="azuriranjeProizvoda.php">Ažuriranje</a></li>    
            <li><a href="vizuelizacija.php">Vizuelizacija</a></li>
            <li><a href="lokacije.php">Lokacije</a></li>             
        </ul> 
    </nav> 
    
	  <div id="container">
        <div id="content_left" style="width:900px;"> 
            <div class="post" style="width:900px;">
                <div class="post_body">
                    <?php 
                        $urlTipovi = 'http://localhost/BookShop/tipovi.json';
                        $curlZahtev = curl_init($urlTipovi);
                        curl_setopt($curlZahtev, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curlZahtev, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                        curl_setopt($curlZahtev, CURLOPT_HTTPGET, true);             
                        $tipovi = curl_exec($curlZahtev);
                        curl_close($curlZahtev);
                        $json_tipovi = json_decode($tipovi);
                    ?>
                    <div style="float:left;">
                        <form name="forma" method="GET">
                            Prikaz vizuelizacije za tip:
                            <select id="tip" name="tip">
                                <option value="" selected="selected"></option>
                                <?php
                                    foreach($json_tipovi->tipovi as $tip) {
                                        echo "<option value='$tip->idtip'>$tip->tip</option>";
                                    }
                                ?>                      
                            </select> 
                        </form>
                    </div>
                    <button name="dugmence" id="dugmence" class="button-success" style="width:200px;margin-right:150px; float:right; height:30px;">Prikaži</button> <br><br><br>
                    <div id="chart_div"></div>   
                </div>
            </div>      
        </div>   
    </div> <br><br><br>

    <footer>
        <?php echo "<br><b>&copy; ". date("Y") ." Sva prava zadržana.</b><br><br>";?>
    </footer>
</body>
</html>