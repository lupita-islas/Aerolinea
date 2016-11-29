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
<body>
    <h1>Seleccione su asiento</h1>
    <!--aqui insertar la funcion de php para ver los asientos -->
    <?php
    $numero_personas=2;
    $h=0;
    $id=1;
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
    for($i=1;$i<8;$i++){

        if(in_array($i,$ides)){
            echo "<span class='glyphicon glyphicon-oil asiento primeraClase ocupado'  data-toggle='tooltip' title='Asiento numero:" . $i . "'    name='asientoPrimera' aria-hidden='true'></span>";
        }else {
            echo "<span class='glyphicon glyphicon-oil asiento primeraClase' onclick='choose(" . ($i) . ",this)' data-toggle='tooltip' title='Asiento numero:" . $i . "'  onmouseout='cambio(this)' onmouseover='seleccion(this)'  name='asientoPrimera' aria-hidden='true'></span>";
        }
        if ($i % 2 == 0) {
            echo " || <br> || ";
        }
    }
    echo"|| ";
    for($i=8; $i<=52; $i++) {

    if(in_array($i,$ides)){
        echo "<span class='glyphicon glyphicon-oil asiento ocupado'  data-toggle='tooltip' title='Asiento numero:" . $i . "'    name='asientoPrimera' aria-hidden='true'></span>";
    }else {
        echo "<span class='glyphicon glyphicon-oil asiento' onclick='choose(" . $i . ",this)' id='clase' data-toggle='tooltip' title='Asiento numero:" . $i . "'  onmouseout='cambio(this)' onmouseover='seleccion(this)'  name='asiento' aria-hidden='true'></span>";
    }
        if ($i % 4 == 0) {
            echo "||<br>";
        }
        if ($i % 2 == 0) {
            echo " ||  ";
        }

    }



    echo "<form action='asientosSelec.php' method='post'>";

    echo "<input type='text'  id='asientos'  hidden name='asientos' '>";
    echo "<input type='submit' class='btn btn-lg btn-success' value='Siguiente'>";
    echo "</form>";

    ?>
    <script type="text/javascript">
        var numPer= <?php echo $numero_personas ?>;
        var numAs="";
        function seleccion(x) {
            if(!x.id.match('clase')) {
                x.className = "glyphicon glyphicon-oil seleccionado asiento primeraClase";
            }else {
                x.className = "glyphicon glyphicon-oil seleccionado asiento ";
            }
        }
        function cambio(x) {
            if(!x.id.match('clase'))
                x.className="glyphicon glyphicon-oil asiento primeraClase";
            else
                x.className="glyphicon glyphicon-oil asiento ";
        }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        function choose(x,y) {

            if(numPer!=0) {
                if (confirm("Esta seguro de usar este el asiento numero:  " + x)) {
                    if (!y.id.match('clase')) {
                        y.className = "glyphicon glyphicon-oil asiento primeraClase ocupado";

                    } else {
                        y.className = "glyphicon glyphicon-oil asiento ocupado";
                    }
                    numAs+=x.toString()+":";
                    numPer--
                    y.onmouseout = '';
                    y.onmouseover = '';
                } else {
                    // y.className="glyphicon glyphicon-credit-card ocupado";
                }
            }else{
                alert("Ya no puede seleccionar mas asientos");

            }
            document.getElementById("asientos").value=numAs;
        }

    </script>

</body>
</html>