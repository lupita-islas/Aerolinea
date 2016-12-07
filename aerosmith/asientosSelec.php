<?php
session_start();
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 29/11/2016
 * Time: 12:54 PM
 */
//suponemos que el id del vuelo
include("conexion.php");
$id=$_POST['id'];
$clase=$_POST['clase'];
$numeros=$_POST['asientos'];
$_SESSION['asientos'].=(string)$numeros;
$asientos=explode(":",$numeros);
$redondo=$_SESSION['isRedondo'];///aqui verificamos si es redondo
for($i=0;$i<count($asientos)-1;$i++){

    $sql="INSERT INTO asientos (Id_vuelo,Num_asiento,Clase, Estado) VALUES('$id','$asientos[$i]','$clase','Vendido') ";
    if(!base($sql)){
        echo "Error";
    }
}

if($redondo){
    //cambiar redondo a false
    $redondo=false;
    $_SESSION['courrent']=false;
    echo "<script>
        window.location='asientos.php';
    </script>";
}else{
    echo "<script>
        window.location='Extras.html';
    </script>";
}