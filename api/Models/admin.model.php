<?php
require_once 'Connection.php';

class AdminModel{

//INSERT INTO `categoria`(`ID_Categoria`, `Nombre`, `Estatus`) VALUES (null,'backend',0)
static public function registrarcat($data){
    //prepara la sentencia sql pero no la ejecuta
    $stmt = Connection::connect()->prepare( 'INSERT INTO categoria VALUES (null,:nombre,0)');
    $stmt->bindParam( ':nombre',$data['nombre'] );//aqui estamos diciendo, en donde encuentres :nombre, cambiamelo
                                                //por lo que haya en el json con la cabecera 'nombre'
    $stmt->execute();//ejecuta la sentencia
    return '¡Se Registro Correctamente la categoria!';




}



}




?>