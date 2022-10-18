<?php
class UsuarioController{

    public function Error( $e ) {
        header( 'HTTP/1.0 500' );
        //Cabecera que Indica que hay un error en el Servidor
        $json = array( 'message' => '¡Hubo un Error!', 'status'=>500, 'data' => $e->getMessage() );
        echo json_encode( $json );
        return ;
    }



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
    
    static public function login($data){

        $datos=UsuarioModel::login($data);

    }
    


    static public function registrarse($data){
        try{
            if(isset( $data[ "nombre_usu" ]) &&  isset( $data["correo"]) && isset( $data["pass"]) &&isset( $data["fecha_nac"]) && isset( $data["img"]) && isset( $data["descripcion"])){
                $datos=UsuarioModel::registrarse($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }
        }catch(Exception $e){

            self::Error($e);


        }
    }

    static public function darbajausu($data){
        try{

            if(isset($data["id_usuario"])){
                $datos=UsuarioModel::darbajausu($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }


        }catch(Exception $e){
            self::Error($e);
        }
    }

    static public function comentarpost($data){

        try{
            if(isset($data["id_post"]) && isset($data["id_usuario"]) && isset($data["comentario"])){

                $datos=UsuarioModel::comentarpost($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;


            }

        }catch(Exception $e){
            self::Error($e);
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
    static public function reaccionarpost($data){

        try{
            if(isset($data["id_post"])&& isset($data["id_usuario"])){
                $datos=UsuarioModel::reaccionarpost($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }

    

    static public function reaccionarcomentario($data){

        try{
            if(isset($data["id_comm"])&& isset($data["id_usuario"])){
                $datos=UsuarioModel::reaccionarcomentario($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }

    static public function delcomentario($data){

        try{
            if(isset($data["id_comm"])){
                $datos=UsuarioModel::delcomentario($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }
    static public function delreacpost($data){

        try{
            if(isset($data["id_post"]) && isset($data["id_usu"])){
                $datos=UsuarioModel::delreacpost($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }
    static public function delreaccomm($data){

        try{
            if(isset($data["id_comm"]) && isset($data["id_usu"])){
                $datos=UsuarioModel::delreaccomm($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }

    static public function delpost($data){

        try{
            if(isset($data["id_post"])){
                $datos=UsuarioModel::delpost($data);
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> $datos );
                echo json_encode( $json );
                return;
            }else{
                header( 'HTTP/1.0 500 ' );
                    echo 'Datos incompletos';
            }


        }catch(Exception $e){
            self::Error($e);
        }


    }

}






?>