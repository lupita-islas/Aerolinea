<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Datos Cliente</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<h2>Registro de pasajeros </h2>
<?php
$numPas=$_SESSION['total'];//aqui va la variable de sesion $_SESSION(['total'])

echo $numPas;
if($numPas>0) {
    echo '
<form action="clientesExtrass.php"  method="post">
    <h2>Informacion de Cliente</h2>
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


    <br><br><input type="submit" class="btn-success , btn-primary" value="Siguiente">
    
</form>';
    $numPas--;
    $_SESSION['total']--;
}else{
    echo "<script>
    window.location='asientos.php';
        </script>";
}

?>
</body>
</html>
