<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_POST) {
    $usuario = $_POST["txtUsuario"];
    $clave = $_POST["txtClave"];

    if ($usuario == "admin" && $clave == "contraseña") {
        header("Location: http://localhost/php/formulario_login/acceso-confirmado.php");
    } else {
        $msg = "Valido para usuarios registrados";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="py-3">
                <h1>Formulario</h1>
            </div>
        </div>
        <div class="row">
            <div class="py-3">
                <?php if (isset($msg)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php }; ?>
            </div>
        </div>
        </div>
        <form method="POST" action="">
            <div class="my-3">
                <label for="txtUsuario">Usuario</label>
                <input class="form-control" type="text" name="txtUsuario" id="txtUsuario">
            </div>
            <div class="my-3">
                <label for="txtClave">Clave</label>
                <input class="form-control" type="password" name="txtClave" id="txtClave">
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary my-3">ENVIAR</button>
            </div>
        </form>
        </div>
        </div>
    </main>
</body>

</html>