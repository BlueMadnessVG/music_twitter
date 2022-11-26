
<?php
//si vas a hacer un nuevo modelo/controlador o algo, lo metes aqui
require_once "Controllers/ruta.controller.php";
require_once "Controllers/usuarios.controller.php";
require_once "Controllers/admin.controller.php";
require_once "Controllers/Correo.controller.php";
require_once "Models/usuarios.model.php";
require_once "Models/admin.model.php";
require_once "Models/Correo.model.php";
require_once './libraries/src/JWT.php';
require_once './libraries/src/Key.php';
require_once 'Models/Enviroment.php';
$objRuta = new  RutaController();
$objRuta->inicio(); //Nos redirijira al archivo page.php


?>