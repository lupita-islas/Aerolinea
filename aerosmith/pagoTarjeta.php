<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 07/12/2016
 * Time: 01:31 PM
 */
include ("conexion.php");
$nombre=$_POST['nombre'];
$numero=$_POST['numero'];
$seguridad=$_POST['seguridad'];
$fecha=$_POST['vencimiento'];
$tipo=$_POST['tipo'];

$sql="INSERT INTO pago_tarjeta(nombre,numeroTarjeta,secCode,fecha,tipo) VALUES('$nombre','$numero','$seguridad','$fecha','$tipo') ";
if(base($sql)){
    echo "<script>
        var clave=Math.floor(Math.random()*10000000000000);
            alert(\"Pago realizado correctamente, puede pasar a recoger sus boletos de avion  \" +
                    \"con la siguiente clave:  \"+clave);
            window.location=\"fin.html\";
    </script>";
}