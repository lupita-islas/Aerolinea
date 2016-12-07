<!DOCTYPE html>
<?php
session_start();
$extras=$_SESSION['instrumentos']+$_SESSION['maleta']+$_SESSION['abordo'];
//AQUI DEBERIA SUMAR EL TOTAL TOTAL
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Metodo de pago</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
        <input type="text"  class="form-control-static" value="<?php echo $extras?>" disabled>
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
</body>
</html>