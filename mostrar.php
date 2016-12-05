<?php
/**
 * Created by PhpStorm.
 * User: ruth
* Date: 03/12/16
* Time: 4:19 PM
*/


session_start();

$eleccion=$_GET["temp"];
if(!isset($eleccion)){
    $eleccion="2";
}

$vuelos=$_SESSION["vuelos"];
$max=$_SESSION["numero"];

echo $vuelos[0][3];
echo $_SESSION["sal_org"];
echo $_SESSION["tipo"];
    //global $f;
    ?>
    <script>
        var id;
        id=2;
        function antes(){
            id=1;
            window.location = 'mostrar.php?temp='+id;
        }
        function justo(){
            id=2;
            //window.location = window.location+'?temp='+id;
            window.location = 'mostrar.php?temp='+id;
        }
        function despues(){
            id=3;
            //window.location = window.location+'?temp='+id;
            window.location = 'mostrar.php?temp='+id;
        }
    </script>
    <?php
        if($_SESSION["tipo"]=="sencillo"){
            echo '<form name="Ida" action="clients.php" method="post">';
        }else{
            echo '<form name="Ida" action="verificar_reg.php" method="post">';
        }
    ?>

    <table style="border:solid 1px black " align="center" cellspacing="10px" id="basic-table">
        <tr>
            <th><p id="antes" onclick="antes()"><?php echo $_SESSION["sal_bef"]; ?></p></th>
            <th><p id="justo" onclick="justo()"><?php echo $_SESSION["sal_org"]; ?></p></th>
            <th><p id="antes" onclick="despues()"><?php echo $_SESSION["sal_af"]; ?></p></th>
        </tr>
        <tr>
            <th>VUELO</th>
            <th>TURISTA</th>
            <th>PRIMERA</th>
        </tr>

        <!--<script>
           (function () { -->
        <?php
        //if(isset($eleccion)) {
            echo $eleccion;
            for ($x = 0; $x < $max; $x++) {
                ?>
                <tr>

                    <?
                    //echo $vuelos[$x][3];
                    if ($eleccion == 1) {
                        if ($vuelos[$x][3] == $_SESSION["sal_bef"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            if($vuelos[$x][3]!=null){
                                echo '<br>' . $vuelos[$x][10] ;
                            }
                            echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][11];
                                $_SESSION["precio"]=$vuelos[$x][11];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][12];
                                $_SESSION["precio"]=$vuelos[$x][12];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][13];
                                $_SESSION["precio"]=$vuelos[$x][13];
                            }
                            echo '<br>Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'" > ';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][14];
                                $_SESSION["precio"]=$vuelos[$x][14];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][15];
                                $_SESSION["precio"]=$vuelos[$x][15];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][16];
                                $_SESSION["precio"]=$vuelos[$x][16];
                            }
                            echo '<br> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }
                    } else if ($eleccion == 2) {
                        if ($vuelos[$x][3] == $_SESSION["sal_org"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][11];
                                $_SESSION["precio"]=$vuelos[$x][11];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][12];
                                $_SESSION["precio"]=$vuelos[$x][12];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][13];
                                $_SESSION["precio"]=$vuelos[$x][13];
                            }
                            echo '<br>Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'"> ';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][14];
                                $_SESSION["precio"]=$vuelos[$x][14];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][15];
                                $_SESSION["precio"]=$vuelos[$x][15];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][16];
                                $_SESSION["precio"]=$vuelos[$x][16];
                            }
                            echo '<br> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }

                    } else if ($eleccion == 3) {
                        if ($vuelos[$x][3] == $_SESSION["sal_af"]) {
                            echo '<td>' . $vuelos[$x][1] . ' ' . $vuelos[$x][4];
                            echo '<br>' . $vuelos[$x][2] . ' ' . $vuelos[$x][6];
                            echo '</td>';
                            echo '<td> <input type="radio" name="clase" value="0_'.$vuelos[$x][0].'" >';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][11];
                                $_SESSION["precio"]=$vuelos[$x][11];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][12];
                                $_SESSION["precio"]=$vuelos[$x][12];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][13];
                                $_SESSION["precio"]=$vuelos[$x][13];
                            }
                            echo '<br>Disponibles:' . $vuelos[$x][8] . '</td>';
                            echo '<td> <input type="radio" name="clase" value="1_'.$vuelos[$x][0].'"> ';
                            if($_SESSION["precio_ida"]=="Precio_corto"){
                                echo '$'.$vuelos[$x][14];
                                $_SESSION["precio"]=$vuelos[$x][14];
                            }else if($_SESSION["precio_ida"]=="Precio_medio"){
                                echo '$'.$vuelos[$x][15];
                                $_SESSION["precio"]=$vuelos[$x][15];
                            }else if($_SESSION["precio_ida"]=="Precio_largo"){
                                echo '$'.$vuelos[$x][16];
                                $_SESSION["precio"]=$vuelos[$x][16];
                            }
                            echo '<br> Disponibles:' . $vuelos[$x][9] . '</td>';
                        }

                    }
                    ?>
                </tr>
                <?php
            }
        //}
        ?>
    </table>
    <input type="submit" value="Continuar">
        </form>


