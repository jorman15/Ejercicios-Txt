<?php
if (isset($_GET['carpeta'])) {
    $carpeta = urldecode($_GET['carpeta']);
    $nombreArchivoZip = 'Carpetas.zip';

    $zip = new ZipArchive();
    if ($zip->open($nombreArchivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        agregarArchivosAlZip($carpeta, $zip);
        $zip->close();

        if (file_exists($nombreArchivoZip)) {
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($nombreArchivoZip) . '"');
            header('Content-Length: ' . filesize($nombreArchivoZip));
            readfile($nombreArchivoZip);

            unlink($nombreArchivoZip);
            exit;
        } else {
            echo 'Error al crear el archivo ZIP.';
        }
    } else {
        echo 'Error al abrir el archivo ZIP.';
    }
} else {
    echo 'Carpeta no especificada.';
}

function agregarArchivosAlZip($carpeta, $zip) {
    $archivos = glob($carpeta . '*');

    foreach ($archivos as $archivo) {
        if (is_file($archivo)) {
            $zip->addFile($archivo, str_replace($carpeta, '', $archivo));
        } elseif (is_dir($archivo)) {
            $zip->addEmptyDir(str_replace($carpeta, '', $archivo));
            agregarArchivosAlZip($archivo . '/', $zip);
        }
    }
}

?>