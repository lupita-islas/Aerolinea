<?php
session_start();
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 03/12/2016
 * Time: 02:06 PM
 */
include("conexion.php");

if(!empty($_POST['nombreCliente'])) {
    $nombre =strtoupper($_POST['nombreCliente']);
    $segundoNombre = strtoupper($_POST['segundoNombre']);
    $apellidoPat = strtoupper($_POST['apellidoPat']);
    $apellidoMat = strtoupper($_POST['apellidoMat']);
    $tel = $_POST['tel'];
    $tipo=strtoupper($_POST['tipo']);
    $email = $_POST['email'];
    $fechaNac=$_POST['fechNac'];
    $genero=strtoupper($_POST['genero']);
    $nacionalidad=strtoupper($_POST['nacionalidad']);
    $sql1="INSERT into clientes(nombre,seg_nombre,apellido_Pat,apellido_Mat,Genero,Fecha_Nac,Nacionalidad,Telefono,email,tipo)VALUES('$nombre','$segundoNombre','$apellidoPat','$apellidoMat','$genero','$fechaNac','$nacionalidad','$tel','$email','$tipo')";
    if(base($sql1)){
        $band1=true;
        echo "<script>
                   alert('Registro insertado correctamente');
                   window.location='clientesExtras.php'; 
                    </script>";
    }else{
        echo "Error cliente";
    }

}