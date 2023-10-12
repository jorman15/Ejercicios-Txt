<!DOCTYPE html>
<html>
<head>
    <title>Bloc de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #F8F8F8;
            border: 1px solid #DDD;
        }

        h2 {
            margin-top: 0;
        }

        label {
            font-weight: bold;
        }

        textarea {
            width: 100%;
            height: 400px;
            resize: vertical;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: #FFF;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST['carpeta_seleccionada']) && isset($_POST['archivo_seleccionado'])) {
            $carpeta = $_POST['carpeta_seleccionada'];
            $archivo = $_POST['archivo_seleccionado'];

            $ruta_archivo = 'archivos/' . $carpeta . '/' . $archivo;

            if (file_exists($ruta_archivo)) {
                $contenido = file_get_contents($ruta_archivo);
        ?>

                <h2>Editar archivo: <?php echo $archivo; ?></h2>

                <form action="guardar_edicion.php" method="POST">
                    <input type="hidden" name="carpeta_seleccionada" value="<?php echo $carpeta; ?>">
                    <input type="hidden" name="archivo_seleccionado" value="<?php echo $archivo; ?>">

                    <label for="nombre_archivo">Nombre del archivo:</label>
                    <br>
                    <input type="text" name="nombre_archivo" value="<?php echo $archivo; ?>">
                    <br><br>

                    <textarea name="contenido"><?php echo $contenido; ?></textarea>
                    <br>

                    <input type="submit" value="Guardar cambios">
                </form>
        <?php
            } else {
                echo "<p>El archivo $archivo no existe.</p>";
            }
        } else {
            echo "<p>No se ha especificado una carpeta o archivo.</p>";
        }
        ?>
    </div>
</body>
</html>