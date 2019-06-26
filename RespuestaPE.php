
<?php
//LLamando
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="images/iconobad.ico" />
    <title>Drabgon Table Tennis</title>

</head>
<body>

  PEDIDO REALIZADO, PARA VOLVER A INICIO PRESIONE REGRESAR

   <a href="index.php"> <input type="button"  value="regresar" name=""></a>

    <h1>REVISE SU CORREO</h1>

<?php   session_destroy(); ?>

</body>
</html>