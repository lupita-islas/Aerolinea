<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vuelos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icono.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="estilos2.css">
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand" src="images/airplane.png">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="vuelos.php">Aerosmith</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-1 sidenav">
        </div>
        <div class="col-sm-10 text-left">

            <?php
            /**
             * Created by PhpStorm.
             * User: ruth
             * Date: 03/12/16
             * Time: 4:19 PM
             */


            session_start();

            /*$eleccion=$_GET["temp"];
            if(!isset($eleccion)){
                $eleccion="2";
            }*/
            if(isset($_GET["temp"])){
                $eleccion=$_GET["temp"];
            }else{
                $eleccion="2";
            }

            $vuelos=$_SESSION["vuelos"];
            $max=$_SESSION["numero"];

            /*echo $vuelos[0][3];
            echo $_SESSION["sal_org"];
            echo $_SESSION["tipo"];*/
            //global $f;
            ?>
            <script>
                var id;
                id=2;
                function antes(){
                    id=1;
                    window.location = 'mostrar2.php?temp='+id;
                }
                function justo(){
                    id=2;
                    //window.location = window.location+'?temp='+id;
                    window.location = 'mostrar2.php?temp='+id;
                }
                function despues(){
                    id=3;
                    //window.location = window.location+'?temp='+id;
                    window.location = 'mostrar2.php?temp='+id;
                }
            </script>
            <form name="Ida" action="clients.php" method="post">
            <section class="fechas">
                <ul class="nav nav-pills nav-justified">
                    <li><a data-toggle="pill" id="antes" onclick="antes()"><?php echo $_SESSION["reg_bef"]; ?></a></li>
                    <li><a data-toggle="pill" id="justo" onclick="justo()"><?php echo $_SESSION["reg_org"]; ?></a></li>
                    <li><a data-toggle="pill" id="antes" onclick="despues()"><?php echo $_SESSION["reg_af"]; ?></a></li>
                </ul>
            </section>
            <!--
            <ul class="nav nav-pills nav-justified">
                <li><a data-toggle="pill" id="antes" onclick="antes()"><?php echo $_SESSION["sal_bef"]; ?></a></li>
                <li class="active"><a data-toggle="pill" id="justo" onclick="justo()"><?php echo $_SESSION["sal_org"]; ?></a></li>
                <li><a data-toggle="pill" id="antes" onclick="despues()"><?php echo $_SESSION["sal_af"]; ?></a></li>
            </ul>

                <ul class="nav nav-pills nav-justified">
                    <li><p id="antes" onclick="antes()"><?php echo $_SESSION["sal_bef"]; ?></p></li>
                    <li class="active"><p id="justo" onclick="justo()"><?php echo $_SESSION["sal_org"]; ?></p></li>
                    <li><p id="antes" onclick="despues()"><?php echo $_SESSION["sal_af"]; ?></p></li>
                </ul>-->
            <div class="container-fluid central">
                <!--<table style="border:solid 1px black " align="center" cellspacing="10px" id="basic-table">-->
                <div class="row">
                    <div class="col-sm-4 color">VUELO</div>
                    <div class="col-sm-4 color">TURISTA</div>
                    <div class="col-sm-4 color">PRIMERA</div>
                </div>
                <!--<script>
                   (function () { -->
                <?php
                //if(isset($eleccion)) {
                //echo $eleccion;
                for ($x = 0; $x < $max; $x++) {
                    ?>
                    <!--<tr>-->
                    <div class="row">
                        <?php
                        //echo $vuelos[$x][3];
                        if ($eleccion == 1) {
                            if ($vuelos[$x][3] == $_SESSION["reg_bef"]) {
                                echo '<div class="col-sm-4">' . $vuelos[$x][1] . " " . $vuelos[$x][4];
                                if($vuelos[$x][3]!=null){
                                    echo '<br>' . $vuelos[$x][10] ;
                                }
                                echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                                echo '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                                //turista
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][11];
                                    $_SESSION["precio2"]=$vuelos[$x][11];
                                    $_SESSION["diferencia2"]=$vuelos[$x][14] - $vuelos[$x][11];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][12];
                                    $_SESSION["precio2"]=$vuelos[$x][12];
                                    $_SESSION["diferencia2"]=$vuelos[$x][15] - $vuelos[$x][12];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][13];
                                    $_SESSION["precio2"]=$vuelos[$x][13];
                                    $_SESSION["diferencia2"]=$vuelos[$x][16] - $vuelos[$x][13];
                                }
                                echo '<br>Disponibles:' . $vuelos[$x][8] . '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'" > ';
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][14];
                                    $_SESSION["precio2"]=$vuelos[$x][14];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][15];
                                    $_SESSION["precio2"]=$vuelos[$x][15];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][16];
                                    $_SESSION["precio2"]=$vuelos[$x][16];
                                }
                                echo '<br> Disponibles:' . $vuelos[$x][9] . '</div>';
                            }
                        } else if ($eleccion == 2) {
                            if ($vuelos[$x][3] == $_SESSION["reg_org"]) {
                                echo '<div class="col-sm-4">' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                                echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                                echo '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][11];
                                    $_SESSION["precio2"]=$vuelos[$x][11];
                                    $_SESSION["diferencia2"]=$vuelos[$x][14] - $vuelos[$x][11];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][12];
                                    $_SESSION["precio2"]=$vuelos[$x][12];
                                    $_SESSION["diferencia2"]=$vuelos[$x][15] - $vuelos[$x][12];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][13];
                                    $_SESSION["precio2"]=$vuelos[$x][13];
                                    $_SESSION["diferencia2"]=$vuelos[$x][16] - $vuelos[$x][13];
                                }
                                echo '<br>Disponibles:' . $vuelos[$x][8] . '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'"> ';
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][14];
                                    $_SESSION["precio2"]=$vuelos[$x][14];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][15];
                                    $_SESSION["precio2"]=$vuelos[$x][15];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][16];
                                    $_SESSION["precio2"]=$vuelos[$x][16];
                                }
                                echo '<br> Disponibles:' . $vuelos[$x][9] . '</div>';
                            }

                        } else if ($eleccion == 3) {
                            if ($vuelos[$x][3] == $_SESSION["reg_af"]) {
                                echo '<div class="col-sm-4">' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                                echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                                echo '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][11];
                                    $_SESSION["precio2"]=$vuelos[$x][11];
                                    $_SESSION["diferencia2"]=$vuelos[$x][14] - $vuelos[$x][11];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][12];
                                    $_SESSION["precio2"]=$vuelos[$x][12];
                                    $_SESSION["diferencia2"]=$vuelos[$x][15] - $vuelos[$x][12];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][13];
                                    $_SESSION["precio2"]=$vuelos[$x][13];
                                    $_SESSION["diferencia2"]=$vuelos[$x][16] - $vuelos[$x][13];
                                }
                                echo '<br>Disponibles:' . $vuelos[$x][8] . '</div>';
                                echo '<div class="col-sm-4"> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'"> ';
                                if($_SESSION["precio_ida"]=="Precio_corto"){
                                    echo '$'.$vuelos[$x][14];
                                    $_SESSION["precio2"]=$vuelos[$x][14];
                                }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                    echo '$'.$vuelos[$x][15];
                                    $_SESSION["precio2"]=$vuelos[$x][15];
                                }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                    echo '$'.$vuelos[$x][16];
                                    $_SESSION["precio2"]=$vuelos[$x][16];
                                }
                                echo '<br> Disponibles:' . $vuelos[$x][9] . '</div>';
                            }

                        }
                        ?>
                    </div>
                    <?php
                }
                //}
                ?>
            </div>

            <section class="botones">
                <input type="submit" value="Continuar">
            </section>
            <?php
            echo "</form>";
            ?>


        </div>
        <div class="col-sm-1 sidenav">
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Aerolinea AEROSMITH<br>Rodriguez Huerta César Omar | Islas Ortega Ruth Guadalupe<br>ISC 5C</p>
</footer>

</body>
</html>
