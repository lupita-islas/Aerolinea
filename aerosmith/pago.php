<!DOCTYPE html>
<?php
session_start();
$_SESSION['extras']=$_SESSION['instrumentos']+$_SESSION['maleta']+$_SESSION['abordo'];
//AQUI DEBERIA SUMAR EL TOTAL TOTAL
if(isset($_SESSION['extras'])){
    $_SESSION['totalDinero']+=$_SESSION['extras'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Metodo de pago</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/icono.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=estilos.css>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="#">Aerosmith</a></li>

            </ul>

        </div>
    </div>
</nav>
<div class="container">
<h1>Forma de pago</h1>
    <div class="divPago">
        <img src="images/tarjetas.jpg" class="imagenPago"><br><br>
        <button class="btn btn-warning btn-lg"  onclick="tarjeta()" type="button">Tarjeta de Credito/Debito</button>
        <br><br>
    </div>

    <div class="divPago">
        <img src="images/deposito.png" class="imagenPago"><br><br>
        <button class="btn btn-warning btn-lg"  onclick="deposito()" type="button">Deposito Bancario</button>
    </div>
    <br>
    <br>
    <div class="divHide input-group " id="formtarjeta" style="display: none">
        <h4>Cantidad a pagar: </h4>
        <form method="post" action="pagoTarjeta.php">
        <span class="glyphicon glyphicon-usd " aria-hidden="true"></span>
        <input type="text"  class="form-control-static" value="<?php echo  $_SESSION['totalDinero']?>" disabled>
        <br>
        <span class="glyphicon glyphicon-user " aria-hidden="true"></span>
        <input type="text" name="nombre" class="form-control-static" placeholder="Nombre ">
        <br>
        <span class="glyphicon glyphicon-credit-card " aria-hidden="true"></span>
        <input type="text" name="numero" class="form-control-static" required placeholder="Numero de Tarjeta">
        <br>
        <span class="glyphicon glyphicon-lock " aria-hidden="true"></span>
        <input type="text" name="seguridad" class="form-control-static" maxlength="4" required placeholder="Codigo de Seguridad">
        <br>
        <span class="glyphicon glyphicon-calendar " aria-hidden="true"></span>
        <input type="month"   name="vencimiento" class="form-control-static" required placeholder="Fecha de vencimiento">
        <br>
        <span class="glyphicon glyphicon-list-alt " aria-hidden="true"></span>
        <select class="form-control-static" name="tipo">
            <option value="visa">VISA</option>
            <option value="masterCard">Master Card</option>
        </select>
        <br>
        <br>
        <button type="submit"  class="btn-success btn-md">PAGAR</button>
            </form>
    </div>
    </div>
    <script>
        function deposito() {

            if(confirm("Esta seguro de realizar un deposito bancario? Esto le podra quitar " +
                            "su valioso tiempo")){
                //generar PDF
                window.location="pdfPago.php";
            }else{

            }
        }
        function tarjeta() {
            if (document.getElementById('formtarjeta').style.display == 'block') {
                document.getElementById('formtarjeta').style.display = 'none';
            }else{
                document.getElementById('formtarjeta').style.display = 'block';
            }


        }
        function pago() {

        }

    </script>
<div>
        <footer class="container-fluid text-center">
            <p>Aerolinea AEROSMITH<br>Rodriguez Huerta César Omar | Islas Ortega Ruth Guadalupe<br>ISC 5C</p>
        </footer>
</div>
</body>
</html>