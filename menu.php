<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<meta charset="UTF-8">
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">E BIBLIOTEKA</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Početna</a></li>
                        <li><a href="kontakt.php">Podrška</a></li>
						<li><a href="poslovanje.php">Poslovanje</a></li>
                        <li><a href="cene.php">Cene</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Za kupce <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="mojePorudzbine.php">Moje porudžbine</a></li>
                                <?php if(isset($_SESSION['email'])){?>
                            <li><a href="izloguj.php">Odjavi se</a></li>
                            <?php } else { ?>
                                <li><a href="logovanje.php">Prijavi se</a></li>
                                <li><a href="registracijaKupca.php">Nov kupac</a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Za zaposlene <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                            <?php if(isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com"){

                                ?>
                            <li><a href="proizvodi_admin.php">Proizvodi</a></li>
                            <li><a href="unosenjeProizvoda.php">Nov proizvod</a></li>
                            <li><a href="porudzbine_admin.php">Porudžbine</a></li>
                            <li><a href="izloguj.php">Odjavi se</a></li>

                            <?php } else { ?>
                            <li><a href="logovanje.php">Prijavi se</a></li> 
                            <?php }?>
                            </ul>
                            
                        </li>
                        <li><a href="cenovnik.php">Cenovnik</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<style type="text/css">
    #DataTables_Table_0_info {
        visibility: hidden;
    }

</style>