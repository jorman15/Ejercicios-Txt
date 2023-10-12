<?php
if (isset($_POST['carpeta_seleccionada']) && isset($_POST['archivo_seleccionado']) && isset($_POST['nombre_archivo']) && isset($_POST['contenido'])) {
    $carpeta = $_POST['carpeta_seleccionada'];
    $archivo = $_POST['archivo_seleccionado'];
    $nombreArchivo = $_POST['nombre_archivo'];
    $contenido = $_POST['contenido'];

    $ruta_archivo = 'archivos/' . $carpeta . '/' . $archivo;

    if (file_exists($ruta_archivo)) {
        if ($nombreArchivo !== $archivo) {
            $nuevaRutaArchivo = 'archivos/' . $carpeta . '/' . $nombreArchivo;
            rename($ruta_archivo, $nuevaRutaArchivo);
            $ruta_archivo = $nuevaRutaArchivo;
        }

        file_put_contents($ruta_archivo, $contenido);
        echo '<script>alert("Los cambios se han guardado correctamente en el archivo ' . $nombreArchivo . '"); window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("El archivo ' . $archivo . ' no existe."); window.location.href = "index.php";</script>';
    }
} else {
    echo '<script>alert("No se han proporcionado los datos necesarios para guardar los cambios."); window.location.href = "index.php";</script>';
}
?>