<?php
if (isset($_GET['carpeta'])) {
    $carpeta = $_GET['carpeta'];

    $directorio = 'archivos/' . $carpeta;

    $archivos = glob($directorio . '/*');

    $nombresArchivos = array();
    foreach ($archivos as $archivo) {
        $nombreArchivo = basename($archivo);
        $nombresArchivos[] = $nombreArchivo;
    }

    echo json_encode($nombresArchivos);
} else {
    echo 'No se ha especificado una carpeta';
}