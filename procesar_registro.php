<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];

    // Validación de nombre completo
    if (empty($_POST["nombre_completo"]) || !preg_match("/^[A-Za-z\s]{3,50}$/", $_POST["nombre_completo"])) {
        $errores[] = "El nombre completo debe tener entre 3 y 50 letras.";
    }

    // Validación de email
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email es obligatorio y debe ser válido.";
    }

    // Validación de fecha de nacimiento
    if (empty($_POST["fecha_nacimiento"])) {
        $errores[] = "La fecha de nacimiento es obligatoria.";
    }

    // Validación de género
    if (empty($_POST["genero"])) {
        $errores[] = "El género es obligatorio.";
    }

    // Validación de teléfono
    if (empty($_POST["telefono"]) || !preg_match("/^[0-9]{9}$/", $_POST["telefono"])) {
        $errores[] = "El teléfono debe tener 9 dígitos.";
    }

    // Validación de país
    if (empty($_POST["paises"]) || $_POST["paises"] == "vacio") {
        $errores[] = "Selecciona un país.";
    }

    // Validación de términos y condiciones
    if (empty($_POST["terminos"])) {
        $errores[] = "Debes aceptar los términos y condiciones.";
    }

    // Validación de archivo de foto de perfil
    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == 0) {
        $file_size = $_FILES["foto_perfil"]["size"];
        $file_type = $_FILES["foto_perfil"]["type"];

        if ($file_size > 300000) {
            $errores[] = "La imagen debe ser menor de 300 KB.";
        }

        if ($file_type != "image/jpeg" && $file_type != "image/png") {
            $errores[] = "La imagen debe estar en formato JPEG o PNG.";
        }
    }

    // Mostrar errores o confirmar registro
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        echo "<h2 style='color: green;'>Registro completado correctamente.</h2>";
        echo "<h3>Resumen de datos:</h3>";
        echo "<p><strong>Nombre completo:</strong> " . $_POST["nombre_completo"] . "</p>";
        echo "<p><strong>Nombre de artista:</strong> " . $_POST["nombre_artista"] . "</p>";
        echo "<p><strong>Email:</strong> " . $_POST["email"] . "</p>";
        echo "<p><strong>Fecha de nacimiento:</strong> " . $_POST["fecha_nacimiento"] . "</p>";
        echo "<p><strong>Género:</strong> " . $_POST["genero"] . "</p>";
        echo "<p><strong>Teléfono:</strong> " . $_POST["telefono"] . "</p>";
        echo "<p><strong>País:</strong> " . $_POST["paises"] . "</p>";

        // Mostrar habilidades seleccionadas
        if (isset($_POST["habilidades"])) {
            echo "<p><strong>Habilidades:</strong> " . implode(", ", $_POST["habilidades"]) . "</p>";
        } else {
            echo "<p><strong>Habilidades:</strong> No seleccionadas</p>";
        }

        echo "<p><strong>Descripción:</strong> " . $_POST["descripcion"] . "</p>";

        // Mostrar foto de perfil si se ha subido
        if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == 0) {
            // Mostrar la imagen subida
            $rutaImagen = "uploads/" . basename($_FILES["foto_perfil"]["name"]);
            move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $rutaImagen);
            echo "<p><strong>Foto de perfil subida correctamente:</strong></p>";
            echo "<img src='$rutaImagen' alt='Foto de perfil' style='max-width: 200px; max-height: 200px;'>";
        } else {
            echo "<p><strong>Foto de perfil:</strong> No se ha subido ninguna imagen.</p>";
        }
    }
}
?>
