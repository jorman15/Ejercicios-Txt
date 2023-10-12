<?php
$nombre_carpeta = $_POST['nombre_carpeta'];

$carpeta = 'archivos/' . $nombre_carpeta;

if (!file_exists($carpeta)) {
    if (mkdir($carpeta)) {
        echo '<script>alert("La carpeta se ha creado satisfactoriamente.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo "Error al crear la carpeta.";
    }
} else {
    echo '<script>alert("La carpeta ya existe.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
}
?>