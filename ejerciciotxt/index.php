<!DOCTYPE html>
<html>
<head>

  <title>Bloc de Notas</title>
  <link rel="shortcut icon" href="cuaderno.ico" type="image/x-icon">
  
    <title>Bloc de Notas</title>
    <style>
        body {
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            }

            h1 {
            text-align: center;
            font-family: "Courier New", monospace;
            font-size: 24px;
            margin-top: 0;
            }

            form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            }

            label {
            font-family: "Courier New", monospace;
            }

            input[type="text"], textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            }

            input[type="submit"] {
            padding: 8px 16px;
            font-family: "Courier New", monospace;
            font-size: 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            }

            input[type="submit"]:hover {
            background-color: #45a049;
            }

            select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            }
    </style>
</head>
<body>
    <h1>Bloc de Notas</h1>

    <form action="guardar_archivo.php" method="POST">
        <label for="carpeta">Selecciona una carpeta:</label>
        <br>
        <select name="carpeta">
            <?php
            $directorio = 'archivos/';
            $carpetas = glob($directorio . '*', GLOB_ONLYDIR);
            foreach ($carpetas as $carpeta) {
                $nombreCarpeta = basename($carpeta);
                echo "<option value='$nombreCarpeta'>$nombreCarpeta</option>";
            }
            ?>
        </select>
        <br>
        <label for="nombre_archivo">Nombre del archivo:</label>
        <br>
        <input type="text" name="nombre_archivo">
        <br>
        <label for="contenido">Contenido:</label>
        <br>
        <textarea name="contenido" rows="10" cols="50"></textarea>
        <br>
        <input type="submit" value="Guardar archivo">
    </form>

    <form action="crear_carpeta.php" method="POST" onsubmit="return validarFormulario()">
        <label for="nombre_carpeta">Nombre de la carpeta:</label>
        <br>
        <input type="text" name="nombre_carpeta" required>
        <br>
        <br>
        <input type="submit" value="Crear carpeta">
    </form>

    <script>
        
        function validarFormulario() {
            const nombreCarpeta = document.querySelector('input[name="nombre_carpeta"]').value;

            if (nombreCarpeta === '') {
                alert('Por favor, ingrese un nombre para la carpeta.');
                return false; 
            }

            return true; 
        }
    </script>

    <form action="leer_carpetas.php" method="POST">
        <input type="submit" value="Ver y Descargar Carpetas">
    </form>

    <form action="leer_archivo.php" method="POST" onsubmit="return validarFormulario()">
        <label for="carpeta_seleccionada_leer" style="font-weight: bold; text-align: center; display: block; font-size: 22px;">LEER ARCHIVO</label>
        <br>
        <label for="carpeta_seleccionada_leer">Seleccionar carpeta:</label>
        <br>
        <select name="carpeta_seleccionada" id="carpeta_seleccionada_leer" required>
            <?php
            $directorio = 'archivos/';
            $carpetas = glob($directorio . '*', GLOB_ONLYDIR);
            foreach ($carpetas as $carpeta) {
                $nombreCarpeta = basename($carpeta);
                echo "<option value='$nombreCarpeta'>$nombreCarpeta</option>";
            }
            ?>
        </select>
        <br>
        <label for="archivo_seleccionado_leer">Seleccionar archivo:</label>
        <br>
        <select name="archivo_seleccionado" id="archivo_seleccionado_leer" required></select>
        <br>
        <br>
        <input type="submit" value="Seleccionar Archivo">
    </form>

    <script>
        
        const carpetaSeleccionadaLeer = document.getElementById('carpeta_seleccionada_leer');
        const archivoSeleccionadoLeer = document.getElementById('archivo_seleccionado_leer');

        
        function cargarArchivosLeer() {
            
            const carpetaLeer = carpetaSeleccionadaLeer.value;

            const xhrLeer = new XMLHttpRequest();
            xhrLeer.onreadystatechange = function() {
                if (xhrLeer.readyState === XMLHttpRequest.DONE) {
                    if (xhrLeer.status === 200) {

                        archivoSeleccionadoLeer.innerHTML = '';

                        const archivosLeer = JSON.parse(xhrLeer.responseText);

                        archivosLeer.forEach(function(archivo) {
                            const option = document.createElement('option');
                            option.value = archivo;
                            option.text = archivo;
                            archivoSeleccionadoLeer.appendChild(option);
                        });
                    } else {
                        console.error('Error al cargar los archivos para leer');
                    }
                }
            };
            xhrLeer.open('GET', 'obtener_archivos.php?carpeta=' + carpetaLeer, true);
            xhrLeer.send();
        }

        carpetaSeleccionadaLeer.onchange = cargarArchivosLeer;

        function validarFormulario() {
            const carpetaSeleccionada = carpetaSeleccionadaLeer.value;
            const archivoSeleccionado = archivoSeleccionadoLeer.value;

            if (carpetaSeleccionada === '' || archivoSeleccionado === '') {
                alert('Por favor, seleccione una carpeta y un archivo.');
                return false; 
            }

            return true; 
        }
    </script>

<br>

    <form action="editar_archivo.php" method="POST" onsubmit="return validarFormulario()">
        <label for="carpeta_seleccionada" style="font-weight: bold; text-align: center; display: block; font-size: 22px;">EDITAR ARCHIVO</label>
        <br>
        <label for="carpeta_seleccionada">Seleccionar carpeta:</label>
        <br>
        <select name="carpeta_seleccionada" id="carpeta_seleccionada" required>
            <?php
            $directorio = 'archivos/';
            $carpetas = glob($directorio . '*', GLOB_ONLYDIR);
            foreach ($carpetas as $carpeta) {
                $nombreCarpeta = basename($carpeta);
                echo "<option value='$nombreCarpeta'>$nombreCarpeta</option>";
            }
            ?>
        </select>
        <br>
        <label for="archivo_seleccionado">Seleccionar archivo:</label>
        <br>
        <select name="archivo_seleccionado" id="archivo_seleccionado" required></select>
        <br>
        <br>
        <input type="submit" value="Seleccionar Archivo">
    </form>

    <script>

        const carpetaSeleccionada = document.getElementById('carpeta_seleccionada');
        const archivoSeleccionado = document.getElementById('archivo_seleccionado');

        function cargarArchivos() {
     
            const carpeta = carpetaSeleccionada.value;

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        archivoSeleccionado.innerHTML = '';

                        const archivos = JSON.parse(xhr.responseText);

                        archivos.forEach(function(archivo) {
                            const option = document.createElement('option');
                            option.value = archivo;
                            option.text = archivo;
                            archivoSeleccionado.appendChild(option);
                        });
                    } else {
                        console.error('Error al cargar los archivos');
                    }
                }
            };
            xhr.open('GET', 'obtener_archivos.php?carpeta=' + carpeta, true);
            xhr.send();
        }

        carpetaSeleccionada.onchange = cargarArchivos;

        function validarFormulario() {
            const carpetaSeleccionada = carpetaSeleccionada.value;
            const archivoSeleccionado = archivoSeleccionado.value;

            if (carpetaSeleccionada === '' || archivoSeleccionado === '') {
                alert('Por favor, seleccione una carpeta y un archivo.');
                return false;
            }

            return true; 
        }
    </script>

</body>
</html>