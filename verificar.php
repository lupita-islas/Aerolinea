<?php
session_start();
include("conexion.php");
$origen=$_POST["origen"];
$destino=$_POST["destino"];
$fecha_sal=$_POST["salida"];
$fecha_reg=$_POST["regreso"];
$adulto=$_POST["pasajero_adu"];
$menor=$_POST["pasajero_ni"];
$reg_bef=$_POST["reg_bef"];
$reg_af=$_POST["reg_af"];
$sal_bef=$_POST["sal_bef"];
$sal_af=$_POST["sal_af"];
$total_bol=$adulto + $menor;

$_SESSION["origen"]=$origen;
$_SESSION["destino"]=$destino;
$_SESSION["adulto"]=$adulto;
$_SESSION["menor"]=$menor;
$_SESSION["salida"]=$fecha_sal;
$_SESSION["regreso"]=$fecha_reg;
$_SESSION["boletos"]=$total_bol;

echo $origen;
echo $destino;
echo $fecha_sal;
echo $fecha_reg;
echo $adulto;
echo $menor;
echo $total_bol;
echo '<br>';


if($conn->connect_error) {
    die("Error en la conexion".$conn->connect_error);
}else {
    $sql="SELECT * from vuelo where Origen='$origen'";
    $rec= $conn->query($sql);

    if ($rec->num_rows>0) {

        if($conn->connect_error) {
            die("Error en la conexion".$conn->connect_error);
        }else{
            $sql1="SELECT * from vuelo where Origen='$origen' and Destino='$destino' and fecha_salida BETWEEN '$sal_bef' and '$sal_af'";
            $resultado=$conn->query($sql1);
            if($resultado->num_rows>0) {
                while($row = $resultado->fetch_assoc()) {
                    echo $row["Origen"];
                    echo $row["Destino"];
                    echo $row["id"];
                    echo $row["Fecha_salida"];
                    echo $row["Hora_salida"];
                    echo '<br>';

                }
            }else{
                ?> <script>
                    alert('No se encontro ningún vuelo ');
                    window.location = 'vuelos.html';
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert('No se encontro ningún vuelo desde su origen');
            window.location = 'vuelos.html';
        </script>
        <?php
    }
}


?>
