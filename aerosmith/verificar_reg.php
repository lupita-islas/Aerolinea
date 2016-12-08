<?php
session_start();
include("conexion2.php");

$variable=$_POST["clase"];
//echo $variable;
$temporal=explode("_",$variable);
$_SESSION["clase_ida"]=$temporal[0];
$_SESSION["id_vuelo_ida"]=$temporal[1];

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
                    $vuelos_reg[$f][10]=$row["Escala"];

                    //Precios
                    $vuelos_reg[$f][11]=$row["Precio_corto_t"];
                    $vuelos_reg[$f][12]=$row["Precio_medio_t"];
                    $vuelos_reg[$f][13]=$row["Precio_largo_t"];
                    $vuelos_reg[$f][14]=$row["Precio_corto_p"];
                    $vuelos_reg[$f][15]=$row["Precio_medio_p"];
                    $vuelos_reg[$f][16]=$row["Precio_largo_p"];

                    /*echo $vuelos_reg[$f][0];
                    echo $vuelos_reg[$f][1];
                    echo $vuelos_reg[$f][2];
                    echo $vuelos_reg[$f][3];
                    echo $vuelos_reg[$f][4];*/

                    $f+=1;

                }
                $_SESSION["numero_reg"]=$f;



                for($x=0; $x<$f; $x++){
                    $turista=0;
                    $primera=0;
                    $id=$vuelos_reg[$x][0];
                    $sql_dis="SELECT * from asientos where Id_vuelo='$id'";
                    $res_dis=$conn->query($sql_dis);
                    if($res_dis->num_rows>0){
                        while($res = $res_dis->fetch_assoc()) {
                            if ($res['Clase'] == "PRIMERA") {
                                $primera++;
                            } else {
                                $turista++;
                            }
                        }
                    }
                    $tot_prim=8-$primera;
                    $tot_tur=44-$turista;
                    $vuelos_reg[$x][8]=$tot_tur;
                    $vuelos_reg[$x][9]=$tot_prim;
                }
                $_SESSION["vuelos_reg"]=$vuelos_reg;

                $cont_disp_t=0;
                $cont_disp_p=0;
                for($x=0; $x<$f; $x++){
                    $cont_disp_t+=$vuelos_reg[$x][8];
                    $cont_disp_p+=$vuelos_reg[$x][9];
                }
                if($cont_disp_t<=$total_bol && $cont_disp_p<=$total_bol){
                    ?> <script>
                        alert('No hay suficientes asientos ');
                        window.location = 'vuelos.php';
                    </script>
                    <?php
                }

                //mostrar();
                ?> <script>
                    window.location = 'mostrar2.php';
                </script>
                <?php

            }else{
                ?> <script>
                    alert('No se encontro ningún vuelo ');
                    window.location = 'vuelos.php';
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert('No se encontro ningún vuelo de regreso');
            window.location = 'vuelos.php';
        </script>
        <?php
    }
}
