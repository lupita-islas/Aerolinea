<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 29/11/2016
 * Time: 12:54 PM
 */
//suponemos que el id del vuelo
include("conexion.php");
$id=1;
$numeros=$_POST['asientos'];
$asientos=explode(":",$numeros);

for($i=0;$i<count($asientos)-1;$i++){
    $sql="INSERT INTO asientos (Id_vuelo,Num_asiento, Estado) VALUES('$id','$asientos[$i]','Vendido') ";
    if(!base($sql)){
        echo "Error";
    }
}