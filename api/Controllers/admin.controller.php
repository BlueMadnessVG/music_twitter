<?php

class AdminController{

    // --------------------------------------    CRUD DE MUSICA    --------------------------------------

    static public function mostrarMus( $data ) {

        try {

            $collection = AdminModel :: mostrarMus( $data );

            $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $collection );
            echo json_encode( $json );//se codifica para mandarlo pa atras
            return;

        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function registrarMus( $data ) {

        try {

            if( isset( $data[ 'id_usr' ] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'id_categoria' ] ) && isset( $data[ 'id_album' ] ) && isset( $data[ 'duracion' ] ) && isset( $data[ 'path' ] ) ) {

                $data = AdminModel :: registrarMus( $data );

                $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data  );
                echo json_encode( $json );
                return;
            }

        }
        catch ( Exception $e1 ){
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function modificarMus( $data ) {

        try {
                if( isset( $data[ 'id_musica' ] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'id_categoria' ] ) && isset( $data[ 'id_album' ] ) && isset( $data[ 'duracion' ] ) && isset( $data[ 'path' ] ) && isset( $data[ 'estatus' ] ) ) {

                    $data = AdminModel :: modificarMus( $data );

                    $json = array ( 'message' => '¡ Operacion Exitosa !', 'status' => 200, 'data' => $data  );
                    echo json_encode( $json );
                    return;
                }
        }
        catch ( Exception $e1 ){
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }
    }

    // --------------------------------------    CRUD DE PUBLICACIONES    --------------------------------------
    
    static public function mostrarPost( $data ) {

        try {

            $collection = AdminModel :: mostrarPost( $data );

            $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $collection );
            echo json_encode( $json );//se codifica para mandarlo pa atras
            return;

        }
        catch ( Exception $e1 ) {
            $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
            echo json_encode( $json );
        }

    }

    static public function registrarPost( $data ) {

        try {
                if ( isset( $data[ 'id_usr' ] ) && isset( $data[ 'comentario' ] ) && isset( $data[ 'id_musica' ] ) && isset( $data[ 'id_album' ] ) ) {

                    $data = AdminModel :: registrarPost( $data );

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

    static public function modificarPost( $data ) {

        try {
                if (  isset( $data[ 'id_post' ] ) && isset( $data[ 'comentario' ] ) && isset( $data[ 'id_musica' ] ) && isset( $data[ 'id_album' ] ) && isset( $data[ 'estatus' ] ) ) {

                    $data = AdminModel :: modificarPost( $data );

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

    // --------------------------------------    CRUD DE USUARIOS    --------------------------------------

    static public function mostrarUsr( $data ) {

        try {

            $collection = AdminModel :: mostrarUsr( $data );

            $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $collection );
            echo json_encode( $json );//se codifica para mandarlo pa atras
            return;

        }
        catch ( Exception $e1 ) {
            $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
            echo json_encode( $json );
        }

    }

    static public function registrarUsr( $data ) {

        try {
                if ( isset( $data[ 'nombre' ] ) && isset( $data[ 'correo' ] ) && isset( $data[ 'contraseña' ] ) && isset( $data[ 'fecha_nacimiento' ] ) && isset( $data[ 'foto_perfil' ] ) && isset( $data[ 'descripcion' ] ) && isset( $data[ 'tipo' ] ) ) {

                    $data = AdminModel :: registrarUsr( $data );

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

    static public function modificarUsr( $data ) {

        try {
                if (  isset( $data[ 'id_usr' ] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'correo' ] ) && isset( $data[ 'contraseña' ] ) && isset( $data[ 'fecha_nacimiento' ] ) && isset( $data[ 'foto_perfil' ] ) && isset( $data[ 'descripcion' ] ) && isset( $data[ 'tipo' ] ) ) {

                    $data = AdminModel :: modificarUsr( $data );

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

    static public function cambiarCont( $data ) {

        try {
                if (  isset( $data[ 'id_usr' ] ) && isset( $data[ 'contraseña' ] ) ) {

                    $data = AdminModel :: cambiarCont( $data );

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

    // --------------------------------------    CRUD DE ALBUM    --------------------------------------

    static public function monstrarAlbum( $data ) {

        try {
                $collection = AdminModel :: mostrarAlb( $data );

                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $collection );
                echo json_encode( $json );//se codifica para mandarlo pa atras
                return;
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function registrarAlb( $data ) {

        try {
                if( isset( $data[ 'usuario' ] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'duracion' ] ) ){

                    $mess = AdminModel :: registrarAlb( $data );

                    $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $mess );
                    echo json_encode( $json );//se codifica para mandarlo pa atras

                    return; 
                }
        }
        catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    static public function modificarAlb( $data ) {

        try {
                if ( isset( $data[ 'id_album' ] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'duracion' ] ) && isset( $data[ 'estatus' ] ) ) {

                    $mess = AdminModel :: modificarAlb( $data );

                    $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $mess );
                    echo json_encode( $json );//se codifica para mandarlo pa atras

                    return; 

                }
        }
        catch ( Exception $e1 ){
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

    // --------------------------------------    CRUD DE CATEGORIAS    --------------------------------------

    static public function mostrarCat( $data ) {

        try {
                $collection = AdminModel :: mostrarCat( $data );

                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $collection );
                echo json_encode( $json );//se codifica para mandarlo pa atras
                return;
        }
        catch ( Exception $e1 ){

                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );  

        }

    }

    static public function registrarcat( $data ) {
        try {
                if ( isset( $data[ 'nombre' ] ) ){//valida que si se mande un dato en esta cabecera del json

                    $datos = AdminModel :: registrarcat( $data );//mandamos a llamar al modelo (hace la sentencia sql)
                        //nos va a regresar un json con esto
                    $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                    echo json_encode( $json );//se codifica para mandarlo pa atras
                    return;
                }
        }catch( Exception $e1 ) {//en caso de que no haya nada en esa cabecera(s)
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }
    }

    static public function modificarCat( $data ) {

        try {
                if (  isset( $data['id_categoria'] ) && isset( $data[ 'nombre' ] ) && isset( $data[ 'estatus' ] ) ){

                    $mess = AdminModel :: modificarCat( $data );

                    $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $mess );
                    echo json_encode( $json );//se codifica para mandarlo pa atras
                    return;
                }
        }catch ( Exception $e1 ) {
                $json = array( 'message' => 'Le faltan datos compañero', 'status' => 500, 'data' => $e1 );
                echo json_encode( $json );
        }

    }

   


}






?>