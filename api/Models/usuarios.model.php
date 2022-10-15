<?php
require_once 'Connection.php';

class UsuarioModel{

//INSERT INTO `categoria`(`ID_Categoria`, `Nombre`, `Estatus`) VALUES (null,'backend',0)
static public function pruebaget(){

    $stmt = Connection::connect()->prepare( 'select * from categoria' );

    $stmt->execute();

    return $stmt->fetchAll( PDO::FETCH_ASSOC );//esta linea lo que hace es regresarnos todos los registros
                                                //que nos haya devuelto la sentencia sql



}



}



?>