<!DOCTYPE html>
<html>
<head>
    <title>Contador de Palabras</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("./fondo.jpg.jpg");
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadein 1s;
            opacity: 0.8;
        }

        h2 {
            margin-top: 0;
        }

        input[type="file"],
        input[type="text"],
        input[type="submit"] {
            display: block;
            margin: 10px auto;
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            opacity: 1;
        }

        input[type="submit"] {
            background-color: brown;
            color: #fff;
            cursor: pointer;
            opacity: 0.9;
        }

        #result {
            margin-top: 20px;
        }

        @keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    <script>
        // Función que muestra los resultados de la búsqueda. Se activa una vez das el input submit.
        function showLoader() {
            document.getElementById("result").innerHTML = '<div class="loader"></div>';
        }
    </script>
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
</head>
<body>
    <!-- Primera parte del diseño de la aplicación. -->
    <div class="container">
        <h2>Contador de Palabras</h2>
        <form method="POST" action="" enctype="multipart/form-data" onsubmit="showLoader()">
            <input type="file" name="file" accept=".txt" required>
            <input type="text" name="word" placeholder="Ingrese una palabra" required>
            <input type="submit" value="Contar">
        </form>
        <div id="result"></div>
    </div>


    <!-- Segunda parte del diseño. Hacer las búsquedas con php. -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //  Repaso de variables especiales. El $_FILES es una variable especial en PHP que almacena información sobre el archivo cargado. En este caso, ['file'] se refiere 
            // al nombre del campo de formulario que contiene el archivo y ['tmp_name'] representa el nombre temporal del archivo en el servidor.
            // El $_POST es otra variable especial en PHP que almacena los datos enviados a través de un formulario HTML utilizando el método POST.
            // En este caso, ['word'] se refiere al nombre del campo de formulario que contiene la palabra ingresada.

        $file = $_FILES['file']['tmp_name'];
        $word = $_POST['word'];

        // Leer el contenido del archivo y contar la palabra. Para leer el contenido uso el file_get_contents. https://www.php.net/manual/es/function.file-get-contents.php En el manual php. 
        $content = file_get_contents($file);
        //Se busca con la función substr_count. El primero es el contenido a analizar y el segundo es la palabra que deseamos buscar. https://www.php.net/manual/es/function.substr-count.php
        $count = substr_count($content, $word);

        // Mostrar el resultado de la búsqueda.
        echo '<script>';
        echo 'document.getElementById("result").innerHTML = "La palabra \'' . $word . '\' aparece ' . $count . ' veces en el archivo."';
        echo '</script>';
    }
    ?>
</body>
</html>
