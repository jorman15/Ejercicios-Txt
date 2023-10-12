<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carpetaSeleccionada = $_POST['carpeta'];
    $nombreArchivo = $_POST['nombre_archivo'];
    $contenido = $_POST['contenido'];

    if (empty($carpetaSeleccionada) || empty($nombreArchivo) || empty($contenido)) {
        echo '<script>alert("Por favor, completa todos los campos.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        $rutaCarpeta = 'archivos/' . $carpetaSeleccionada . '/';
        $rutaArchivo = $rutaCarpeta . $nombreArchivo . '.txt';

        if (!file_exists($rutaCarpeta)) {
            echo '<script>alert("La carpeta seleccionada no existe.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } elseif (file_exists($rutaArchivo)) {
            echo '<script>alert("Ya existe un archivo con ese nombre en la carpeta seleccionada.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            $archivo = fopen($rutaArchivo, 'w');
            if ($archivo) {
                fwrite($archivo, $contenido);
                fclose($archivo);
                echo '<script>alert("El archivo se ha guardado correctamente en la carpeta ' . $carpetaSeleccionada . '.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                echo '<script>alert("Error al guardar el archivo.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            }
        }
    }
}
?>