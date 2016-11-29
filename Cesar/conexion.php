<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 25/11/2016
 * Time: 06:02 PM
 */

$servidor="localhost";
$usuario='root';
$password="";
$db="aeropuerto";

$conn=mysqli_connect($servidor,$usuario,$password,$db);

function base($var)
{

    global $conn;
    if ($conn->connect_error) {
        die("Error en la conexion" . $conn->connect_error);
    } else {
        $sql = $var;
        if($conn->query($sql)===TRUE){
            return true;

        }else{
            echo "$conn->error";
            return false;
        }

    }
   // $conn->close();
}
function consulta($var){
    global $conn;
    if($conn->connect_error) {
        die("Error en la conexion".$conn->connect_error);
    }else{
        $rec=$conn->query($var);
        if($rec->num_rows>0) {
            $row = $rec->fetch_array(MYSQLI_ASSOC);
            //return true;
            return $row;
        }else{
            return false;
        }
    }
}