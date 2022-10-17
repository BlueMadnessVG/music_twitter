<?php
class UsuarioController{

    static public function pruebaget() {
        try {

            $datos = UsuarioModel :: pruebaget();

            $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
            echo json_encode( $json );
            return ;
        } catch( Exception $e1 ) {
            self::Error( $e1 );
        }
    }

    // --------------------------------------    PUBLICACIONES    --------------------------------------

    static public function Usr_registrarPost( $data ) {

        try {
                if ( isset( $data[ 'id_usr' ] ) && isset( $data[ 'comentario' ] ) && isset( $data[ 'id_musica' ] ) && isset( $data[ 'id_album' ] ) ) {

                    $data = UsuarioModel :: Usr_registrarPost( $data );

                    $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data  );
                    echo json_encode( $json );
                    return;
                }
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function Usr_modificarPost( $data ) {

        try {
                if (  isset( $data[ 'id_post' ] ) && isset( $data[ 'comentario' ] ) && isset( $data[ 'id_musica' ] ) && isset( $data[ 'id_album' ] ) ) {

                    $data = UsuarioModel :: Usr_modificarPost( $data );

                    $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data  );
                    echo json_encode( $json );
                    return;
                }
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    // --------------------------------------    DAR DE BAJA    --------------------------------------

    static public function Usr_bajaPost( $data ) {

        try {
                if ( isset( $data[ 'id_post' ] ) ) {
                    
                    $data = UsuarioModel :: Usr_bajaPost( $data );

                    $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data );
                    echo json_encode( $json );
                    return;
                }
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function Usr_bajaMus( $data ) {

        try {
                if ( isset( $data[ 'id_musica' ] ) ) {
                    
                    $data = UsuarioModel :: Usr_bajaMus( $data );

                    $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data );
                    echo json_encode( $json );
                    return;
                }
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }



}






?>