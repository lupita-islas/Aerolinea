<?php
session_destroy();
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
$tipo=$_POST["tipo"];
$total_bol=$adulto + $menor;

//fecha de salida y regreso para poder comparar
$_SESSION["sal_org"]=$_POST["sal_org"];
$_SESSION["reg_org"]=$_POST["reg_org"];

$_SESSION["tipo"]=$tipo;
$_SESSION["origen"]=$origen;
$_SESSION["destino"]=$destino;
$_SESSION["adulto"]=$adulto;
$_SESSION["menor"]=$menor;
$_SESSION["salida"]=$fecha_sal;
$_SESSION["regreso"]=$fecha_reg;
$_SESSION["boletos"]=$total_bol;
$_SESSION["reg_bef"]=$reg_bef;
$_SESSION["reg_af"]=$reg_af;
$_SESSION["sal_bef"]=$sal_bef;
$_SESSION["sal_af"]=$sal_af;
$_SESSION["total"]=$total_bol;

/*
echo $origen;
echo $destino;
echo $fecha_sal;
echo $fecha_reg;
echo $adulto;
echo $menor;
echo $total_bol;
echo '<br>';*/

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
                    $vuelos[$f][6]=$row["Hora_legada"];
                    $vuelos[$f][7]="NO"; //seleccionado
                    $vuelos[$f][8]=0; //disponible_turista
                    $vuelos[$f][9]=0;//disponible_primera

                    echo $vuelos[$f][0];
                    echo $vuelos[$f][1];
                    echo $vuelos[$f][2];
                    echo $vuelos[$f][3];
                    echo $vuelos[$f][4];
                    echo '<br>';
                    $f+=1;

                }
                $_SESSION["numero"]=$f;

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

                    }
                    $tot_prim=8-$primera;
                    $tot_tur=44-$turista;
                    $vuelos[$x][8]=$tot_tur;
                    $vuelos[$x][9]=$tot_prim;
                }
                $_SESSION["vuelos"]=$vuelos;

                //mostrar();
                ?> <script>
                    window.location = 'mostrar.php';
                </script>
                <?php

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
    global $f;
    ?>
    <input type="text" id="temporal">
    <script>
        var id;
        id=2;
        function antes(){
            id=1;
            window.location =window.location;
                window.location = window.location+'?temp='+id;
        }
        function justo(){
            id=2;
            window.location = window.location+'?temp='+id;
        }
        function despues(){
            id=3;
            window.location = window.location+'?temp='+id;
        }
    </script>
    <table style="border:solid 1px black " align="center" cellspacing="10px" id="basic-table">
        <tr>
            <th><p id="antes" onclick="antes()"><?php echo $_SESSION["sal_bef"]; ?></p></th>
            <th><p id="justo" onclick="justo()"><?php echo $_SESSION["salida"]; ?></p></th>
            <th><p id="antes" onclick="despues()"><?php echo $_SESSION["sal_af"]; ?></p></th>
        </tr>
            <tr>
                <th>VUELO</th>
                <th>TURISTA</th>
                <th>PRIMERA</th>
            </tr>

        <!--<script>
           (function () {
        <?php
        if(isset($eleccion)) {

            for ($x = 0; $x < $f; $x++) {
                ?>
                <tr>

                    <?php
                    if ($eleccion == 1) {
                        if ($vuelos[$x][3] == $_SESSION["sal_bef"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            echo '<br> >' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }
                    } else if ($eleccion == 2) {
                        if ($vuelos[$x][3] == $_SESSION["salida"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            echo '<br> >' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }

                    } else if ($eleccion == 3) {
                        if ($vuelos[$x][3] == $_SESSION["salida"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            echo '<br> >' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }

                    }
                    ?>
                </tr>
                <?php
            }
        }
        ?>
        </table>-->
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
