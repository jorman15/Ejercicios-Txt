<?php
date_default_timezone_set('America/Caracas');
$carpeta = 'archivos/';

if (is_dir($carpeta)) {
    if ($dh = opendir($carpeta)) {
        echo '<div style="display: flex; flex-wrap: wrap;">'; 

        while (($archivo = readdir($dh)) !== false) {
            if ($archivo != '.' && $archivo != '..') {

                echo '<div style="width: 200px; height: 100px; background-color: #eaeaea; margin: 10px; padding: 10px; border: 1px solid #ccc;">';               
                echo '<strong>' . $archivo . '</strong><br>';               
                echo 'Fecha de modificación: ' . date("d-m-Y h:i:s", filemtime($carpeta . $archivo)) . '<br>';
                echo 'Tamaño: ' . filesize($carpeta . $archivo) . ' bytes<br>';                
                echo '</div>';
            }
        }

        $carpetaDescarga = urlencode($carpeta); 
        echo '</div>'; 

        echo '<div style="margin: 20px; padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; text-align: center;">';
        echo '<p style="margin-bottom: 10px;">';
        echo '<a href="descargar_carpeta.php?carpeta=' . $carpetaDescarga . '" style="text-decoration: none; color: #333; font-weight: bold;">Descargar Carpetas</a>';
        echo '</p>';
        echo '</div>';

        closedir($dh);
    }
}
?>