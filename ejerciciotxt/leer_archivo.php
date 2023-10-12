<!DOCTYPE html>
<html>
<head>
    <title>Lector de Archivos</title>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .file-info {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .file-content {
            white-space: pre-wrap;
            word-wrap: break-word;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Bloc de Notas</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_POST['carpeta_seleccionada'])) {

                $carpeta = $_POST['carpeta_seleccionada'];
                $archivo = $_POST['archivo_seleccionado'];
                $rutaArchivo = "archivos/$carpeta/$archivo";

                if (file_exists($rutaArchivo)) {

                    echo "<p class='file-info'>Archivo: $archivo</p>";

                    $contenido = file_get_contents($rutaArchivo);

                    echo "<pre class='file-content'>$contenido</pre>";
                } else {
                    echo "<p class='error-message'>El archivo seleccionado no existe.</p>";
                }
            } else {
                echo "<p class='error-message'>Error: No se ha seleccionado una carpeta.</p>";
            }
        } else {
            echo "<p class='error-message'>Error: Método de solicitud no válido.</p>";
        }
        ?>
    </div>
</body>
</html>