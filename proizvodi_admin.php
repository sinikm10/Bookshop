<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>BookShop</title>
    <link href="carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.4/media/css/jquery.dataTables.min.css">.
	<!-- <link href="styles.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.4/extensions/Plugins/integration/jqueryui/dataTables.jqueryui.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui-themes-1.11.2/themes/black-tie/jquery-ui.css">
    <link href="proizvodi_admin.css" rel="stylesheet">

    <style>
        .row_selected td {
            background-color: #d3d3d3 !important; 
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".tabela2").dataTable({
                "language": {
                    "url": "DataTables-1.10.4/i18n/serbian.json"
                }
            });
        });
    </script>

</head>
<?php require 'menu.php'; ?>
<?php require 'proizvodi.php'; ?>
<body>


<div class="container marketing">
    <hr class="featurette-divider">

        <?php
                        if(!isset($_SESSION['email'])){

                            echo "Niste ulogovani!";

                        } else 

                        if(isset($_SESSION['email']) && $_SESSION['email'] != "admin@gmail.com") {

                            echo "Vi niste administrator!";

                        } else

                        if(isset($_GET['poruka'])) { 

                                echo "<h3><span style='color:green;'>". $_GET['poruka'] ."</span></h3>";

                        } else {
                      

    $proizvod = new Proizvod();
    $proizvodi = $proizvod->dajProizvode();

    ?>

    <table class="tabela2 display" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Knjiga</th>
                                <th>Autor</th>
                                <th>Žanr</th>
                                <th>Boja</th>
                                <th>Cena</th>
                                <th>Slika</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($proizvodi as $row){
                            ?>
                            <tr id="<?php echo $row->idproizvod;?>">
                                <td><?php echo $row->idproizvod;?></td>
                                <td><?php echo $row->naziv;?></td>
                                <td><?php echo $row->tip;?></td>
                                <td><?php echo $row->dimenzije;?></td>
                                <td><?php echo $row->autor;?></td>
                                <td><?php echo $row->cena;?></td>
                                <td><img src="http://localhost/BookShop<?php echo $row->url; ?>" width='32' height='32'/> </td>
                                <td>
                                <a href="azuriranjeProizvoda.php?idproizvod=<?php echo $row->idproizvod;?>" class="btn btn-success">Ažuriraj<a/>
                                <a href="obrisiProizvod.php?idproizvod=<?php echo $row->idproizvod; ?>" class="btn btn-danger">OBRIŠI<a/>
                                </td>
                            </tr>
                            <?php
                                    }
                            ?>
                        </tbody>
                    </table>


                 <?php } ?>

    <hr class="featurette-divider">


</div><!-- /.container -->

</body>
</html>
