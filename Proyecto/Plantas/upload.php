<?php

require_once ('class/imagen.php');

$imagen = new Imagen();

$genero = $_GET["genero"];
$especie = $_GET["especie"];

$numImages = $imagen->cuantasImagenesTengo($genero,$especie);

if($numImages<3) {
    if (isset($_POST['uploadphoto']) && $_POST['uploadphoto'] == 'Subir') {
        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
            if($_FILES['uploadedFile']['size'] <= 256000){
            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
            $fileName = $_FILES['uploadedFile']['name'];
            $fileSize = $_FILES['uploadedFile']['size'];
            $fileType = $_FILES['uploadedFile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            for ($i = 0; $i < 3; $i++) {
                if ($imagen->yaExisto($genero . $especie . $i . $fileExtension) == 2) {

                    $newFileName = $genero . $especie . $i . '.' . $fileExtension;

                    $allowedfileExtensions = array('jpg', 'png', 'jpeg');
                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        $uploadFileDir = '/opt/lampp/htdocs/Plantas/images/';
                        $dest_path = $uploadFileDir . $newFileName;

                        if (move_uploaded_file($fileTmpPath, $dest_path)) {

                            if ($imagen->subirImagen($_GET["genero"], $_GET["especie"], $newFileName) == '0') {
                                echo 'La imagen se subió con éxito';
                                return header('Refresh: 5; URL=' . $_SERVER['HTTP_REFERER']);
                            } else {
                                echo 'Ups, algo ha fallado';
                                return header('Refresh: 5; URL=' . $_SERVER['HTTP_REFERER']);

                            }
                        } else {
                            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';

                        }
                    }
                }
                $numImages++;
            }
            }
            echo 'El tamaño máximo de subida es de 250KB';
        }
    }
}else{
    echo 'Ya se han subido el número máximo de imágenes (3).';
}

header('Refresh: 5; URL=' . $_SERVER['HTTP_REFERER']); //Me devuelve a la página anterior
?>
