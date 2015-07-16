<?php 
/**
* Funcion que lee el programa de ckeditor
* con ayuda de mi clase personalizada :)
*
**/

require 'PalilloUpload.php';

$ext 	= 	array('jpg', 'png', 'gif', 'jpeg');


$palilloUpload = new PalilloUpload();
$palilloUpload->setExt($ext);

$palilloUpload->upload();
echo $palilloUpload->getStatus();

?>