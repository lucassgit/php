<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//ejemplo 1..
function print_f1($variable)
{
    if (is_array($variable)) {
        $archivo = fopen('datos.txt', 'a+');
        fwrite($archivo, "\n\nDatos del array ==>\n");
        foreach ($variable as $item) {
            fwrite($archivo, $item . "\n");
        }
        fclose($archivo);
    } else {
        $contenido = "Datos de la variable ==>\n" . $variable;
        file_put_contents("datos.txt", $contenido);
    }
    echo "Archivo generado.";
}

//ejemplo 2..
// function print_f2($variable)
// {
//     if (is_array($variable)) {
//         $contenido = "";
//         $archivo1 = fopen("datos.txt", "w");
//         foreach ($variable as $item) {
//             $contenido .= $item . "\n";
//         }
//         fwrite($archivo1, $contenido);
//         fclose($archivo1);
//     } else {
//         file_put_contents("datos.txt", $variable);
//     }
//     echo "Archivo actualizado.";
// }

//ejemplo 3..
// function print_f3($variable)
// {
//     if (is_array($variable)) {
//         $contenido = "";
//         foreach ($variable as $item) {
//             $contenido .= $item . "\n";
//         }
//         file_put_contents("datos.txt", $contenido);
//     } else {
//         file_put_contents("datos.txt", $variable);
//     }
//     echo "Archivo actualizado.";
// }

//Uso..
$aNotas = array(8, 5, 7, 9, 10, 11, 12);
$msg = "mensaje de prueba";
print_f1($aNotas);
