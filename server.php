 <?php
	require 'flight/Flight.php';
	require 'jsonindent.php';

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

	Flight::register('db', 'Database', array('coolshop'));
	$json_podaci = file_get_contents("php://input");
	Flight::set('json_podaci', $json_podaci);

	//Svi proizvodi prikaz
	Flight::route('GET /proizvodi.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		//pretraga ya
		if(isset($_GET['search'])) {

            $pretraga = $_GET['search'];
            $db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", " naziv LIKE '%". $pretraga ."%' " , null);
            $niz = array();
            while($red = $db->getResult()->fetch_object()) {
                $niz[] = $red;
            }
            $json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
            echo '{'.'"proizvodi":'. indent($json_niz) .' }';
            return false;
		}
		//pretraga cenovnika
		if(isset($_GET["str"])){
            $pretraga = $_GET['str'];
            $db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", " naziv LIKE '%". $pretraga ."%' " , null);
            $niz = array();
            while($red = $db->getResult()->fetch_object()) {
                $niz[] = $red;
            }
            $json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
            echo '{'.'"proizvodi":'. indent($json_niz) .' }';
            return false;
        }if(isset($_GET['start'])){
            $start = $_GET['start'];
            $db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", "" , null, $start);
            $niz = array();
            while($red = $db->getResult()->fetch_object()) {
                $niz[] = $red;
            }
            $json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
            echo '{'.'"proizvodi":'. indent($json_niz) .' }';
            return false;
        }
		else {

            $db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", null, null);
            $niz = array();
            while($red = $db->getResult()->fetch_object()) {
                $niz[] = $red;
            }
            $json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
            echo '{'.'"proizvodi":'. indent($json_niz) .' }';
            return false;
		} 
	});


	//Svi proizvodi određenog tipa
	Flight::route('GET /proizvodi/@idtip.json', function($idtip) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);
		
		if(!isset($_GET['search'])) {
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", "proizvodi.idtip = ". $idtip, null);					
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"proizvodi":'. indent($json_niz) .' }';
			return false;
		} 
		else {
			$pretraga = $_GET['search'];
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", " naziv LIKE '%". $pretraga ."%' " , null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"proizvodi":'. indent($json_niz) .' }';
			return false;
		} 
	});

	Flight::route('GET /daj_proizvod/@idproizvod', function($idproizvoda) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$db->select(" proizvodi ", ' * ',  "tipovi", "idtip", "idtip", "proizvodi.idproizvod = ". $idproizvoda, null, null);
		$red = $db->getResult()->fetch_object();
		$json_niz = json_encode($red,JSON_UNESCAPED_UNICODE);
		echo indent($json_niz);
		return false;
	});

		Flight::route('GET /sve_porudzbine', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$db->select(" porudzbine ", ' * ',  "proizvodi", "proizvod", "idproizvod", "", null, null);
		$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo indent($json_niz);
		return false;
	});


		Flight::route('GET /moje_porudzbine/@email', function($email) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$db->select(" porudzbine ", ' * ',  "proizvodi", "proizvod", "idproizvod", "porudzbine.kupac = '". $email."'", null, null);
		$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo indent($json_niz);
		return false;
	});

	Flight::route('GET /tipovi.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);
		$db->select(" tipovi ", '*', "", "", "", null, null);	
		$niz = array();
		while($red = $db->getResult()->fetch_object()) {
			$niz[] = $red;
		}
		$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo '{'.'"tipovi":'. indent($json_niz) .' }';
		return false;
	});

	Flight::route('PUT /proizvodi/@idproizvod', function($idproizvoda) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if($podaci == null) {
			$odgovor["poruka"] = "Niste prosledili podatke!";
			$json_odgovor = json_encode($odgovor);
			echo $json_odgovor;
		} 
		else {
			if(!property_exists($podaci,'naziv') || !property_exists($podaci,'idtip') || !property_exists($podaci,'dimenzije') || !property_exists($podaci,'cena') || !property_exists($podaci,'autor') || !property_exists($podaci,'godina') || !property_exists($podaci,'url')) {
				$odgovor["poruka"] = "Niste prosledili korektne podatke!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			} 
			else {		
				$ret = $db->update("proizvodi", $idproizvoda, array('naziv','idtip','dimenzije','autor','godina','url','cena'),array($podaci->naziv,$podaci->idtip,$podaci->dimenzije,$podaci->autor,$podaci->godina,$podaci->url,$podaci->cena));

				if($ret == true) {
					$odgovor["poruka"] = "Uspešno ste izmenili proizvod!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				} 
				else {
					$odgovor["poruka"] = "Došlo je do greške pri izmeni!".$ret;
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}
	});

	Flight::route('POST /proizvodi', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if($podaci == null) {
		$odgovor["poruka"] = "Niste prosledili podatke!";
		$json_odgovor = json_encode($odgovor);
		echo $json_odgovor;
		return false;
		} 
		else {
			if(!property_exists($podaci,'naziv') || !property_exists($podaci,'idtip') || !property_exists($podaci,'cena') || !property_exists($podaci,'dimenzije') || !property_exists($podaci,'autor') || !property_exists($podaci,'godina') || !property_exists($podaci,'url')) {
				$odgovor["poruka"] = "Niste ispravno uneli sve podatke!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;	
			} 
			else {
				$podaci_query = array();
				foreach($podaci as $k=>$v) {
					$v = "'". $v ."'";
					$podaci_query[$k] = $v;						
				}
				if($db->insert("proizvodi","naziv,idtip,dimenzije,autor,godina,url,cena",array($podaci_query['naziv'], $podaci_query['idtip'],$podaci_query['dimenzije'], $podaci_query['autor'],$podaci_query['godina'],$podaci_query['url'],$podaci_query['cena']))) {
					$odgovor["poruka"] = "Novi proizvod je uspešno unet!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;					
				} 
				else {
					$odgovor["poruka"] = "Došlo je do greške!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}	
	});

	Flight::route('DELETE /proizvodi/@idproizvod', function($idproizvoda) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("proizvodi", array("idproizvod"),array($idproizvoda))) {
			$odgovor["poruka"] = "Proizvod je uspešno obrisan!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		} 
		else {
			$odgovor["poruka"] = "Došlo je do greške prilikom brisanja!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}						
	});

		Flight::route('DELETE /porudzbine/@id', function($id) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("porudzbine", array("id"), array($id))) {
			$odgovor["poruka"] = "Porudzbina je uspešno obrisana!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		} 
		else {
			$odgovor["poruka"] = "Došlo je do greške prilikom brisanja!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}						
	});



		Flight::route('DELETE /kupci/@id', function($id) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("kupac", array("id"), array($id))) {
			$odgovor["poruka"] = "Kupac je uspešno obrisan!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		} 
		else {
			$odgovor["poruka"] = "Došlo je do greške prilikom brisanja!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}						
	});

	Flight::route('GET /vizuelizacija.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if(!isset($_GET['tip'])) {
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", null, null);		
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Proizvod","type":"string"}, {"label":"Cena proizvoda","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {	
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->naziv .'"},{"v":'. $value->cena .'}]},';
			}
			echo $JSONprikaz .']}';		  	
			return false;
		}
		else {
			$tip = $_GET['tip'];
			$db->select(" proizvodi ", ' * ', "tipovi", "idtip", "idtip", "proizvodi.idtip=". $tip, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Proizvod","type":"string"}, {"label":"Cena proizvoda","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {	
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->naziv .'"},{"v":'. $value->cena .'}]},';
			}
			echo $JSONprikaz .']}';		  	
			return false;
		}
	});

	Flight::route('GET /lokacije.json', function(){
		header("Content-Type: application/json; charset=utf-8");

		echo  '{"markeri":[
				  {
				    "latitude":"44.813325",
				    "longitude":"20.472204",
				    "naziv":"Takovska 14"
				  },
				  {
				    "latitude":"44.816217",
				    "longitude":"20.488545",
				    "naziv":"Dragoslava Srejovica 102"
				  },
				  {
				    "latitude":"44.804101",
				    "longitude":"20.518309",
				    "naziv":"Jovanke Radakovic 29"
				  },
				  {
				    "latitude":"44.794702",
				    "longitude":"20.488086",
				    "naziv":"Vidovdanska 35"
				  },
				  {
				    "latitude":"44.817366",
				    "longitude":"20.526168",				
				    "naziv":"Marina 87"
				  },
				  {
				    "latitude":"44.804006",
				    "longitude":"20.496582",				
				    "naziv":"Mite Rakica 35"
				  }
			]}';
		return false;
	});
	
	Flight::start();
?>