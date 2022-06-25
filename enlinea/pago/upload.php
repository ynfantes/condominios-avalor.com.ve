<?php

////obtenemos el archivo a subir
//$file = $_FILES['archivo']['name'];
//
////comprobamos si existe un directorio para subir el archivo
////si no es así, lo creamos
//if(!is_dir("files/")) 
//mkdir("files/", 0777);
//
////comprobamos si el archivo ha subido
//if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"files/".$file))
//{
//sleep(3);//retrasamos la petición 3 segundos
//echo $file;//devolvemos el nombre del archivo para pintar la imagen
//}

if (!empty($_FILES)) {

 $tempFile = $_FILES['file']['tmp_name'];
 // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
 //$targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR ;
 // Adding timestamp with image's name so that files with same name can be uploaded easily.
 $mainFile = $_FILES['file']['name'];

 move_uploaded_file($tempFile,$mainFile);

}