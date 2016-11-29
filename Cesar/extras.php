<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 26/11/2016
 * Time: 09:34 PM
 */
session_start();

$_SESSION['instrumentos']=$_POST['instrumentos'];
$_SESSION['maleta']=$_POST['maleta'];
$_SESSION['abordo']=$_POST['abordo'];
 echo "<script>
        window.location='pago.php';
    </script>";

