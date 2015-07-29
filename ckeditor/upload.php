<?php 
/**
* Funcion que lee el programa de ckeditor
* con ayuda de mi clase personalizada :)
*
**/

require 'PalilloUpload.php';

$ext 	= 	array('jpg', 'png', 'gif', 'jpeg');


$palilloUpload = new PalilloUpload();
$palilloUpload->setPublicUrl('http://puntos.telemedellin.tv/uploads/');
$palilloUpload->setPath('/home2/ab63348/public_html/puntos/uploads/');
$palilloUpload->setExt($ext);

$palilloUpload->upload();
echo $palilloUpload->getStatus();
?>