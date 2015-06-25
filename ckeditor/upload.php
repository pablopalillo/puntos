<?php 

if (file_exists("/var/www/puntos/uploads/" . $_FILES["upload"]["name"]))
{
 echo $_FILES["upload"]["name"] . " already exists. ";
}
else
{
 move_uploaded_file($_FILES["upload"]["tmp_name"],"/var/www/puntos/uploads/" . $_FILES["upload"]["name"]);
 echo  "http://localhost/puntos/uploads/" . $_FILES["upload"]["name"];
}

?>