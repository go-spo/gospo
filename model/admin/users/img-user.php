<?php

if ($_FILES["file"]["error"] != 4) {
    $target_dir = "../../../resources/img/usuarios/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//                 Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "</p>Solamente son permitidas imágenes JPG, JPEG, PNG o GIF</p>";
        $uploadOk = 0;
    }
    if ($_FILES["file"]["size"] > 5000000) {
        echo "<p>El archivo es demasiado grande.</p>";
        $uploadOk = 0;
    }
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "<h1>El archivo " . basename($_FILES["file"]["name"]) . " se ha copiado a la carpeta de destino</h1>";
            echo"<img src='$target_dir/$target_file'>";
        } else {
            echo "<h1>No se ha podido subir la imagen</h1>";
        }
    } else {
        echo "<h1>Ha habido un error al enviar el archivo</h1>";
    }
}
?>