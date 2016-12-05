<!DOCTYPE html>
<?php
session_start();
$_SESSION['numPas']=$_SESSION['total'];
echo $_SESSION['numPas'];
$temporal=$_POST['clase'];
$clase=explode("_",$temporal);
$_SESSION['courrent']=true;
echo $_SESSION['clase_ida'];
echo $_SESSION['id_vuelo_ida'];
//si es sencillo
if(empty($_SESSION['clase_ida']) && empty($_SESSION['id_vuelo_ida'])){//id_vuelo_ida //Si estan vacios quiere decir que es un vuelo sencillo
    echo "sencilla";
    $_SESSION['clase_ida']=$clase[0];
    $_SESSION['idIda']=$clase[1]; //id_vuelo_ida
    $_SESSION['isRedondo']=false;
}else{
    echo "redonda";
    $_SESSION['isRedondo']=true;
    $_SESSION['idVuelta']=$clase[1];
    $_SESSION['clase_vuelta']=$clase[0];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Datos Cliente</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

    <form action="cliente.php"  method="post">
        <h2>Informacion del Cliente Titular</h2>
        <div class="input-group">
            <input type="text" name="nombreCliente"  class="form-control" aria-describedby="basic-addon1" placeholder="Nombre" required><br>
         </div>
        <div class="input-group">
            <input type="text" name="segundoNombre" class="form-control" placeholder="Segundo Nombre"><br>
         </div>
        <div class="input-group">
            <input type="text" name="apellidoPat" class="form-control" placeholder="Apellido Paterno" required><br>
         </div>
        <div class="input-group">
            <input type="text" name="apellidoMat" class="form-control" placeholder="Apellido Materino"><br>
        </div>
        <div class="input-group">
            <select class="form-control" name="tipo">
                <option value="adulto">Adulto</option>
                <option value="menor">Menor</option>
            </select>
        </div>
        <div class="input-group">
            <input type="text" name="nacionalidad" class="form-control" required placeholder="Nacionalidad">
        </div>
        <div class="input-group">
            <input type="text" name="genero" class="form-control" maxlength="1" required placeholder="Genero">
        </div>
        <div class="input-group">
            <input type="date" name="fechNac" class="form-control" required placeholder="Fecha de Nacimiento">
        </div>
        <div class="input-group">
            <input type="number" name="tel" class="form-control" placeholder="Telefono" required><br>
        </div>
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="E-Mail" required><br>
        </div>
        <h2>Informacion de Contacto</h2>
        <div class="input-group">
            <input type="text" name="nombreClienteCon" class="form-control"  placeholder="Nombre" ><br>
            <input type="text" name="segundoNombreCon" class="form-control" placeholder="Segundo Nombre"><br>
            <input type="text" name="apellidoPatCon" class="form-control" placeholder="Apellido Paterno" ><br>
            <input type="text" name="apellidoMatCon" class="form-control" placeholder="Apellido Materino"><br>
            <input type="number" name="telCon" class="form-control" placeholder="Telefono" ><br>
            <input type="email" name="emailCon" class="form-control" placeholder="E-Mail"><br>
        </div>






        <br><br><input type="submit" class="btn-success , btn-primary" value="Siguiente">
    </form>
</body>
</html>