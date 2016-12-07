<?php
session_start();
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seleccion de Asiento</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body onload="setInterval('verificarSiguiente()',100)">
    <h1>Seleccione sus asientos</h1>
    <img class=' asientoImage ' src="images/asiento.png" title='Disponible'>
    <img class=' asientoImage ' src="images/asientoOcup.png" title='Ocupado'>
    <br><br><br>
    <!--aqui insertar la funcion de php para ver los asientos -->
    <?php
    $idReg="Vuelo de ida";
    $numero_personas=$_SESSION['numPas'];
    if($_SESSION['isRedondo']){
        //primero vamos al de ida
        echo "<h2>".$idReg."</h2>";
        $id=$_SESSION['id_vuelo_ida'];
        $clase=$_SESSION['clase_ida'];
    }else{
        $id=$_SESSION['idIda'];//id Vuelo ida NO REDONDO
        $clase=$_SESSION['clase_ida'];
    }


    if($_SESSION['courrent']==false){
        echo "<h2>".$idReg."</h2>";
        $id=$_SESSION['idVuelta'];
        $clase=$_SESSION['clase_vuelta'];
        $_SESSION['ticketRedondo']=true;
        $_SESSION['isRedondo']=false;

    }
    echo $id;
    //$id=1;
    //$clase="0";//1-> primera clase  | 0->clase turista
    $sql="SELECT * FROM asientos WHERE Id_vuelo=$id";
    $rec=$conn->query($sql);
    $j=0;
    $ides[-1]=0;
    if($rec!=null) {
        while ($row = $rec->fetch_array(MYSQLI_ASSOC)) {
            $ides[$j] = $row['Num_asiento'];
            $j++;
        }
    }

    echo "||";
    for($i=1;$i<9;$i++){

        if(in_array($i,$ides)){
            echo "<img class='asientoImage primeraClase' src='images/asientoOcup.png'    data-toggle='tooltip' title='Asiento numero:" . $i . "'    name='asientoPrimera' >";
        }else {
            echo "<img class='asientoImage primeraClase' src='images/asiento.png'   onclick='choose(" . ($i) . ",this)' data-toggle='tooltip' title='Asiento numero:" . $i . "'  onmouseout='cambio(this)' onmouseover='seleccion(this)'  name='asientoPrimera' aria-hidden='true'>";
        }
        if ($i % 2 == 0) {
            echo " || <br> || ";
        }
    }
    echo"<br>|| ";
    for($i=9; $i<=52; $i++) {

    if(in_array($i,$ides)){
        echo "<img class='asientoImage ' src='images/asientoOcup.png'  data-toggle='tooltip' title='Asiento numero:" . $i . "'    name='asientoPrimera' aria-hidden='true'>";
    }else {
        echo "<img class='asientoImage ' src='images/asiento.png' glyphicon-oil asiento' onclick='choose(" . $i . ",this)' id='clase' data-toggle='tooltip' title='Asiento numero:" . $i . "'  onmouseout='cambio(this)' onmouseover='seleccion(this)'  name='asiento' aria-hidden='true'>";
    }
        if ($i % 4 == 0) {
            echo "||<br>";
        }
        if ($i % 2 == 0) {
            echo " ||  ";
        }

    }



    echo "<form action='asientosSelec.php' method='post'>";
    echo "<input type='number' value='".$id."'  hidden name='id'>";
    if($clase==1){
        echo "<input type='text' value='PRIMERA' name='clase' hidden >";
    }else{
        echo "<input type='text' value='TURISTA' name='clase' hidden >";
    }
    echo "<input type='text'  id='asientos'  hidden name='asientos' '>";
    echo "<input type='submit' id='siguiente' class='btn btn-lg btn-success disabled' value='Siguiente'>";
    echo "</form>";

    ?>
    <script type="text/javascript">
        var numPer= <?php echo $numero_personas ?>;
        var claseTipo= <?php echo $clase ?>;
        var numAs="";
        function seleccion(x) {
            if(!x.id.match('clase')) {
               // x.className = "glyphicon glyphicon-oil seleccionado asiento primeraClase";
                x.src='images/asientoSelec.png';
            }else {
                //x.className = "glyphicon glyphicon-oil seleccionado asiento ";
                x.src='images/asientoSelec.png';
            }
        }
        function cambio(x) {
            if(!x.id.match('clase'))
               // x.className="glyphicon glyphicon-oil asiento primeraClase";
                x.src='images/asiento.png';
            else
                //x.className="glyphicon glyphicon-oil asiento ";
                x.src='images/asiento.png';
        }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        function choose(x,y) {
            if(claseTipo!=0 && x>1 && x<=8) {
                asientos(x,y);
            }else{
                if(x>8){
                    asientos(x,y);
                }else{
                    if(confirm("Desea agregar 1500 pesos por ocuapar un lugar de primera clase?")){
                        asientos(x,y);
                        //aumentar variable de cobro :D
                    }
                }
            }

            document.getElementById("asientos").value=numAs;
        }
        function asientos(x,y) {
            if (numPer != 0) {

                if (confirm("Esta seguro de usar este el asiento numero:  " + x)) {
                    if (!y.id.match('clase')) {
                        //y.className = "glyphicon glyphicon-oil asiento primeraClase ocupado";
                        y.src="images/asientoOcup.png";
                    } else {
                        //y.className = "glyphicon glyphicon-oil asiento ocupado";
                        y.src="images/asientoOcup.png";
                    }
                    numAs += x.toString() + ":";
                    numPer--;
                    y.onmouseout = '';
                    y.onmouseover = '';
                } else {
                    // y.className="glyphicon glyphicon-credit-card ocupado";
                }

            } else {
                alert("Ya no puede seleccionar mas asientos");
            }
        }
    function verificarSiguiente() {
        if(numPer==0) {
            document.getElementById("siguiente").className = "btn btn-lg btn-success";

        }
    }
    setInterval('verificarSiguiente()',1000);
    </script>

</body>
</html>