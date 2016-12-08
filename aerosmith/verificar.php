<?php
session_start();
session_destroy();
session_start();
include("conexion2.php");
$origen=$_POST["origen"];
$destino=$_POST["destino"];
$fecha_sal=$_POST["salida"];
if(isset($_POST["regreso"])){
    $fecha_reg=$_POST["regreso"];
}

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
if(isset($fecha_reg)){
    $_SESSION["regreso"]=$fecha_reg;
}

$_SESSION["boletos"]=$total_bol;
$_SESSION["reg_bef"]=$reg_bef;
$_SESSION["reg_af"]=$reg_af;
$_SESSION["sal_bef"]=$sal_bef;
$_SESSION["sal_af"]=$sal_af;
$_SESSION["total"]=$total_bol;
$_SESSION["precio_ida"]=$_POST["precio_ida"];
$_SESSION["precio_reg"]=$_POST["precio_reg"];

/*
echo $origen;
echo $destino;
echo $fecha_sal;
echo $fecha_reg;
echo $adulto;
echo $menor;
echo $total_bol;
echo '<br>';*/

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
                    $vuelos[$f][10]=$row["Escala"];

                    //Precios
                    $vuelos[$f][11]=$row["Precio_corto_t"];
                    $vuelos[$f][12]=$row["Precio_medio_t"];
                    $vuelos[$f][13]=$row["Precio_largo_t"];
                    $vuelos[$f][14]=$row["Precio_corto_p"];
                    $vuelos[$f][15]=$row["Precio_medio_p"];
                    $vuelos[$f][16]=$row["Precio_largo_p"];


                    /*echo $vuelos[$f][0];
                    echo $vuelos[$f][1];
                    echo $vuelos[$f][2];
                    echo $vuelos[$f][3];
                    echo $vuelos[$f][4];
                    echo '<br>';*/
                    $f+=1;

                }
                $_SESSION["numero"]=$f;

                $turista=0;
                $primera=0;

                for($x=0; $x<$f; $x++){
                    $id=$vuelos[$x][0];
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
                    window.location = 'vuelos.php';
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert('No se encontro ningún vuelo desde su origen');
            window.location = 'vuelos.php';
        </script>
        <?php
    }
}
