<?php
class UsuarioController{

    static public function pruebaget() {
        try {

            $datos = UsuarioModel::pruebaget();

            $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
            echo json_encode( $json );
            return ;
        } catch( Exception $e1 ) {
            self::Error( $e1 );
        }
    }



}






?>