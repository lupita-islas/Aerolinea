<?php
session_start();
include("conexion.php");

$variable=$_POST["clase"];
//echo $variable;
$temporal=explode("_",$variable);
$SESSION["clase_ida"]=$temporal[0];
$SESSION["id_vuelo_ida"]=$temporal[1];

$f=0;

$origen=$_SESSION["destino"];
$destino=$_SESSION["origen"];

$sal_bef=$_SESSION["reg_bef"];
$sal_af=$_SESSION["reg_af"];

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
                    $vuelos_reg[$f][0]=$row["Id"];
                    $vuelos_reg[$f][1]=$row["Origen"];
                    $vuelos_reg[$f][2]=$row["Destino"];
                    $vuelos_reg[$f][3]=$row["Fecha_salida"];
                    $vuelos_reg[$f][4]=$row["Hora_salida"];
                    $vuelos_reg[$f][5]=$row["Fecha_llegada"];
                    $vuelos_reg[$f][6]=$row["Hora_legada"];
                    $vuelos_reg[$f][7]="NO"; //seleccionado
                    $vuelos_reg[$f][8]=0; //disponible_turista
                    $vuelos_reg[$f][9]=0;//disponible_primera
                    $f+=1;

                }
                $_SESSION["numero_reg"]=$f;

                $turista=0;
                $primera=0;

                for($x=0; $x<$f; $x++){
                    $id=$vuelos_reg[$x][0];
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
                    $vuelos_reg[$x][8]=$tot_tur;
                    $vuelos_reg[$x][9]=$tot_prim;
                }
                $_SESSION["vuelos_reg"]=$vuelos_reg;

                //mostrar();
                ?> <script>
                    window.location = 'mostrar2.php';
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
            alert('No se encontro ningún vuelo de regreso');
            window.location = 'vuelos.html';
        </script>
        <?php
    }
}
