<?php
session_start();
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 25/11/2016
 * Time: 07:43 PM
 */
include("conexion.php");
$band1=false;
$band2=false;
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

    $_SESSION['clienteTitular']=$nombre." ".$segundoNombre." ".$apellidoPat." ".$apellidoMat;
    $sql1="INSERT into clientes(nombre,seg_nombre,apellido_Pat,apellido_Mat,Genero,Fecha_Nac,Nacionalidad,Telefono,email,tipo)VALUES('$nombre','$segundoNombre','$apellidoPat','$apellidoMat','$genero','$fechaNac','$nacionalidad','$tel','$email','$tipo')";
    if(base($sql1)){
      $band1=true;

    }else{
        echo "Error cliente";
    }

}
if(!empty($_POST['nombreClienteCon'])) {
    $nombreCon = $_POST['nombreClienteCon'];
    $segundoNombreCon = $_POST['segundoNombreCon'];
    $apellidoPatCon = $_POST['apellidoPatCon'];
    $apellidoMatCon = $_POST['apellidoMatCon'];
    $telCon = $_POST['telCon'];
    $emailCon = $_POST['emailCon'];
    $sql2="INSERT into contacto(Nombre,Seg_nommbre,Apellido_Pat,Apellido_Mat,Telefono,email)VALUES('$nombreCon','$segundoNombreCon','$apellidoPatCon','$apellidoMatCon','$telCon','$emailCon')";

    if(base($sql2)){
        $band2="true";
        $sql3="SELECT id from contacto where email='$emailCon'";
        $res=consulta($sql3);
        $id=$res['id'];
        $sql3="UPDATE  clientes SET Id_contacto=$id WHERE email='$email'";
        base($sql3);



    }else{
        echo"error contacto";
    }
}

if($band2==true || $band1==true){
    $_SESSION['total']--;
    if($_SESSION['total']==0){
        echo "<script>
                  // alert('Registro insertado correctamente');
                   window.location='asientos.php'; 
                    </script>";
    }else{
        echo "<script>
                 
                   window.location='clientesExtras.php'; 
                    </script>";
    }

}else{
    echo"Error mal plan";
}

