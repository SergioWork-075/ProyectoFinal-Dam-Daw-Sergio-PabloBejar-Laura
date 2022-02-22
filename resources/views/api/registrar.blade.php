<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="get" name="formularioUsu" action="http://15.188.80.158/ProyectoFinal-Dam-Daw-Sergio-PabloBejar-Laura/public/index.php/comprobarUsuario">
    <label for="email">Correo:</label><br>
    <input type="text" id="email" name="email" value=""><br>
    <label for="lname">Contraseña:</label><br>
    <input type="password" id="password" name="password" value=""><br>
    <input type="submit" value="Submit">
</form>

<script>
    window.onload = function(){
        document.forms['formularioUsu'].submit();
    }
</script>
</body>
</html>
