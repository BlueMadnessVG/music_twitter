<?php

class AdminController{


    static public function registrarcat( $data ) {
        try {
                if(isset($data['nombre'])){//valida que si se mande un dato en esta cabecera del json

                $datos = AdminModel::registrarcat( $data );//mandamos a llamar al modelo (hace la sentencia sql)
                    //nos va a regresar un json con esto
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );//se codifica para mandarlo pa atras
                return;
                }
            } catch( Exception $e1 ) {//en caso de que no haya nada en esa cabecera(s)
                echo("le faltan datos compañero");
        }
    }


}






?>