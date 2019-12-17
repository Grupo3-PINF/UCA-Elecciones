<?php
$user = new App\User();
$user->identificador=$argv[0];
$user->login=$argv[1];
$user->email="prueba@uca.es";
$user->password=$argv[2];
$user->rolActivo=$argv[3];
?>