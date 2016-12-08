<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Vuelos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body onload="checkDate()">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand" src="images/airplane.png">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Aerosmith</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-1 sidenav">
        </div>
        <div class="col-sm-10 text-left Formulario">
            <section class="Formulario" >
            <form name="Vuelos" action="verificar.php" method="post">
                <label class="radio-inline">
                <input type="radio" name="tipo" value="redondo" id="redondo" onchange="elegirTipo()">Ida y vuelta
                </label>
                <label class="radio-inline">
                <input type="radio" name="tipo" value="sencillo" id="sencillo" onchange="elegirTipo()" checked>Solo ida
                </label>
                <div class="input-group">
                    <i class="glyphicon glyphicon-map-marker"></i>
                <select id="origen" name="origen" required onchange="elegirDestino()">
                    <option selected value="null">¿Cuál es tu origen?</option>
                    <option value="AGUASCALIENTES">Aguascalientes</option>
                    <option value="MEXICO">Mexico</option>
                    <option value="MONTERREY">Monterrey</option>
                    <option value="GUADALAJARA">Guadalajara</option>
                    <option value="MERIDA">Mérida</option>
                    <option value="QUINTANA ROO">Quintana Roo</option>
                    <option value="BAJA CALIFORNIA">Baja california</option>
                    <option value="SONORA">Sonora</option>
                    <option value="OAXACA">Oaxaca</option>
                    <option value="IXTAPA">Ixtapa</option>
                </select>
                </div>

                <script>
                    function elegirDestino() {
                        var valor=document.getElementById("origen").value;
                        //valor.value = valor.value.toUpperCase();

                        if(valor!="null") {
                            document.getElementById("destino").removeAttribute("disabled");
                        }else{
                            document.getElementById("destino").setAttribute("disabled");
                        }
                    }

                    function elegirTipo() {
                        //var valor=document.getElementsByName("tipo").value;
                        if(document.getElementById("redondo").checked) {
                            document.getElementById("regreso").removeAttribute("disabled");
                            //document.getElementById("regreso").setAttribute("required");
                        }else if(document.getElementById("sencillo").checked) {
                            document.getElementById("regreso").setAttribute("disabled");
                            //document.getElementById("regreso").removeAttribute("required");
                            document.getElementById("regreso").value=null;
                        }
                    }

                    function checkDate(){
                        var date=new Date();
                        var day=date.getDate();
                        var month=date.getMonth();
                        month+=1;
                        var year=date.getFullYear();
                        var fecha=year+"-"+month+"-"+day;
                        //document.getElementById("demo").innerHTML = fecha;
                        document.getElementById("salida").min=fecha;
                    }

                </script>
                <div class="input-group">
                    <i class="glyphicon glyphicon-map-marker"></i>
                <select id="destino" name="destino" disabled>
                    <option selected>¿Cuál es tu destino?</option>
                    <option value="AGUASCALIENTES">Aguascalientes</option>
                    <option value="MEXICO">México</option>
                    <option value="MONTERREY">Monterrey</option>
                    <option value="GUADALAJARA">Guadalajara</option>
                    <option value="MERIDA">Mérida</option>
                    <option value="QUINTANA ROO">Quintana Roo</option>
                    <option value="BAJA CALIFORNIA">Baja california</option>
                    <option value="SONORA">Sonora</option>
                    <option value="OAXACA">Oaxaca</option>
                    <option value="IXTAPA">Ixtapa</option>
                </select>
                    </div>

                Fecha de salida: <input type="date" name="salida" id="salida" required placeholder="dd/mm/aaaa" onblur="rango_sal()">
                <br>
                Fecha de regreso: <input type="date" name="regreso" id="regreso" placeholder="dd/mm/aaaa" onblur="rango_reg()" disabled>
                <br>
                <br>
                Adultos: <input type="number" name="pasajero_adu" min="1" max="8" value="0" required>
                Niños: <input type="number" name="pasajero_ni" min="0" max="8" value="0">
                <br>
                <section class="botones">
                    <input type="submit" value="Buscar">
                </section>
                <input type="date" name="sal_bef" id="sal_bef" hidden>
                <input type="date" name="sal_af" id="sal_af" hidden>
                <input type="date" name="reg_bef" id="reg_bef" hidden>
                <input type="date" name="reg_af" id="reg_af" hidden>
                <input type="date" name="sal_org" id="sal_org" hidden>
                <input type="date" name="reg_org" id="reg_org" hidden>
                <input type="text" name="precio_ida" id="precio_ida" hidden>
                <input type="text" name="precio_reg" id="precio_reg" hidden>
            </form>
            </section>
            <script>

                function rango_sal() {
                    var es_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
                    if(es_chrome){
                        var fecha=document.getElementById("salida").value;
                        document.getElementById("sal_bef").value=fecha;
                        document.getElementById("sal_af").value=fecha;
                        document.getElementById("sal_bef").stepDown();
                        document.getElementById("sal_af").stepUp();
                    }else {
                        var fecha = document.getElementById("salida").value;
                        var arr = fecha.split("/");
                        var fecha_original=arr[2]+"-"+arr[1]+"-"+arr[0];
                        document.getElementById("sal_org").value = fecha_original;
                        var date = new Date();
                        arr[1] -= 1;
                        date.setFullYear(arr[2], arr[1], arr[0]);

                        var fec_pre = new Date();
                        fec_pre.setFullYear(arr[2], arr[1], arr[0]);

                        date.setDate(date.getDate() + 1);
                        var mes = date.getMonth();
                        mes += 1;
                        var text = date.getFullYear() + "-" + mes + "-" + date.getDate();
                        document.getElementById("sal_af").value = text;

                        var date2 = new Date();
                        date2.setFullYear(arr[2], arr[1], arr[0]);
                        date2.setDate(date2.getDate() -1);
                        var mes2 = date2.getMonth();
                        mes2 += 1;
                        var text2 = date2.getFullYear() + "-" + mes2 + "-" + date2.getDate();
                        document.getElementById("sal_bef").value = text2;

                        //precio
                        var fec_hoy = new Date();
                        fec_hoy.setDate((fec_hoy.getDate()+30))
                        var fec_largo=new Date();
                        fec_largo.setDate(fec_largo.getDate()+90)
                        if(fec_pre < fec_hoy){
                            document.getElementById("precio_ida").value = "Precio_corto";
                        }else if(fec_pre > fec_hoy && fec_pre < fec_largo ){
                            document.getElementById("precio_ida").value = "Precio_medio";
                        }else if(fec_pre > fec_largo ){
                            document.getElementById("precio_ida").value = "Precio_largo";
                        }


                    }
                }
                function rango_reg() {
                    var es_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
                    if(es_chrome){
                        var fecha=document.getElementById("regreso").value;
                        document.getElementById("reg_bef").value=fecha;
                        document.getElementById("reg_af").value=fecha;
                        document.getElementById("reg_bef").stepDown();
                        document.getElementById("reg_af").stepUp();
                    }else {
                        var fecha = document.getElementById("regreso").value;
                        var arr = fecha.split("/");
                        var fecha_original2=arr[2]+"-"+arr[1]+"-"+arr[0];
                        document.getElementById("reg_org").value = fecha_original2;
                        var date = new Date();
                        arr[1] -= 1;
                        date.setFullYear(arr[2], arr[1], arr[0]);

                        var fec_pre = new Date();
                        fec_pre.setFullYear(arr[2], arr[1], arr[0]);

                        date.setDate(date.getDate() + 1);
                        var mes = date.getMonth();
                        mes += 1;
                        var text = date.getFullYear() + "-" + mes + "-" + date.getDate();
                        document.getElementById("reg_af").value = text;

                        var date2 = new Date();
                        arr[1] -= 1;
                        date2.setFullYear(arr[2], arr[1], arr[0]);
                        date2.setDate(date2.getDate() -1);
                        var mes2 = date2.getMonth();
                        mes2 += 1;
                        var text2 = date2.getFullYear() + "-" + mes2 + "-" + date2.getDate();
                        document.getElementById("reg_bef").value = text2;

                        //precio
                        var fec_hoy = new Date();
                        fec_hoy.setDate((fec_hoy.getDate()+30))
                        var fec_largo=new Date();
                        fec_largo.setDate(fec_largo.getDate()+90)
                        if(fec_pre < fec_hoy){
                            document.getElementById("precio_reg").value = "Precio_corto";
                        }else if(fec_pre > fec_hoy && fec_pre < fec_largo ){
                            document.getElementById("precio_reg").value = "Precio_medio";
                        }else if(fec_pre > fec_largo ){
                            document.getElementById("precio_reg").value = "Precio_largo";
                        }
                    }
                }
            </script>
        </div>
        <div class="col-sm-1 sidenav">
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Aerolinea AEROSMITH<br>Rodriguez Huerta César Omar | Islas Ortega Ruth Guadalupe<br>ISC 5C</p>
</footer>

</body>
</html>