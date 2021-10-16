<?php
 
	if (isset($_REQUEST['action'])) {
		switch ($_REQUEST['action']) {
			case 'get_rows':
				getRows();
				break;
			case 'row_count':
				getRowCount();
				break;
			default;
				break;
		}
	} else return false;

	//vraca ukupan broj miseva
	function getRowCount() {

        $url = 'http://localhost/COOLSHOP/proizvodi.json';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);
        $json_objekat = json_decode($curl_odgovor);

        echo count($json_objekat->proizvodi);
	}

	//vraca tri misa pocevsi od startnog broja
	//start je redni broj strane - 1
	function getRows() {
		$start_row = isset($_REQUEST['start'])?$_REQUEST['start']:0;
		$start_row = 3 * (int)$start_row;
		
		$mouses = dajProizvode($start_row);
		
		$formatted_mouses = "<div id='formatted_mouses'>" . formatData($mouses) . "</div>";
		
		echo $formatted_mouses;
	}
	
	function dajProizvode($start_row = 0) {

        $url = 'http://localhost/BookShop/proizvodi.json?start='.$start_row;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);

        $json_objekat = json_decode($curl_odgovor);

        return $json_objekat->proizvodi;
	}
	
	function formatData($proizvodi) {
        $formated = '';
	    foreach ($proizvodi as $proizvod) {

            $formated .= '
			<div class="row featurette">
				<div class="col-md-7">     
					<h2 class="featurette-heading">' .
					$proizvod->naziv . '</h2><hr>
					<p class="lead"> NAZIV: ' . $proizvod->naziv . '</p>
					<p class="lead"> AUTOR: ' . $proizvod->autor . '</p>
					<p class="lead"> ŽANR: ' . $proizvod->tip . '</p>
					<p class="lead"> GODINA IZDANJA: ' . $proizvod->godina . '</p>
					<p class="lead"> CENA: ' . $proizvod->cena . '</p>
					<a href="kupi.php?id='.$proizvod->idproizvod.'" class="btn btn-danger">KUPI</a>
				</div>
				<div class="col-md-5">
					<img class="featurette-image img-responsive center-block" src="/COOLSHOP/' . $proizvod->url . '">
				</div>
			</div>';
        }
        return $formated;
	}
?> 