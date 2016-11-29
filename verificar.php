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

$vuelos;
$f=0;

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
            //Resultado de vuelos
            if($resultado->num_rows>0) {
                while($row = $resultado->fetch_assoc()) {
                    $vuelos[$f][0]=$row["Id"];
                    $vuelos[$f][1]=$row["Origen"];
                    $vuelos[$f][2]=$row["Destino"];
                    $vuelos[$f][3]=$row["Fecha_salida"];
                    $vuelos[$f][4]=$row["Hora_salida"];
                    $vuelos[$f][5]=$row["Fecha_llegada"];
                    $vuelos[$f][6]=$row["Hora_llegada"];
                    $vuelos[$f][7]="NO"; //seleccionado
                    $vuelos[$f][8]="SI"; //disponible_turista
                    $vuelos[$f][9]="SI";//disponible_primera

                    echo $vuelos[$f][0];
                    echo $vuelos[$f][1];
                    echo $vuelos[$f][2];
                    echo $vuelos[$f][3];
                    echo $vuelos[$f][4];
                    echo '<br>';
                    $f+=1;

                }

                $turista=0;
                $primera=0;

                for($x=0; $x<$f; $x++){
                    $id=$vuelos[$x][0];
                    $sql_dis="SELECT * from asientos where Id_vuelo='$id'";
                    $res_dis=$conn->query($sql_dis);
                    if($res_dis->num_rows>=52){
                        if($res['Clase']=="PRIMERA"){
                            $primera++;
                        }else{
                            $turista++;
                        }
                        $vuelos[$x][7]="NO";
                    }
                }

                mostrar();

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

function mostrar(){
    global $vuelos;
    ?>
    <table style="border:solid 1px black " align="center" cellspacing="10px" id="basic-table">
            <tr>
                <th></th>
                <th>OBJETO</th>
                <th>CANTIDAD</th>
                <th>FECHA</th>
                <th>COMPRADO</th>
            </tr>
        <?php
}

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

?>
