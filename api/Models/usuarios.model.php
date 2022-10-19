<?php
require_once 'Connection.php';
use Firebase\JWT\JWT;
class UsuarioModel{

    //INSERT INTO `categoria`(`ID_Categoria`, `Nombre`, `Estatus`) VALUES (null,'backend',0)
    static public function pruebaget(){

        $stmt = Connection::connect()->prepare( 'select * from categoria' );

        $stmt->execute();

        return $stmt->fetchAll( PDO::FETCH_ASSOC );//esta linea lo que hace es regresarnos todos los registros
                                                    //que nos haya devuelto la sentencia sql
    }

    // --------------------------------------    PUBLICACIONES    --------------------------------------

    static public function Usr_registrarPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'INSERT INTO post VALUES ( null, :id_usr, :comentario, :id_musica, :id_album, 0, 0 )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':comentario', $data[ 'comentario' ] );
        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( 'id_album', $data[ 'id_album' ] );

        $stmt -> execute();
        return ' ¡ Post Publicado con Exito ! ';

    }

    static public function Usr_modificarPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE post SET Comentario = :comentario, ID_Musica = :id_musica, ID_Album = :id_album WHERE ID_Post = :id_post' );

        $stmt -> bindparam( 'id_post', $data[ 'id_post' ] );
        $stmt -> bindparam( ':comentario', $data[ 'comentario' ] );
        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( 'id_album', $data[ 'id_album' ] );

        $stmt -> execute();
        return ' ¡ Post Modificado con Exito ! ';
    }

    // --------------------------------------    DAR DE BAJA    --------------------------------------

    static public function Usr_bajaPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'DELETE FROM post WHERE ID_Post = :id_post' );

        $stmt -> bindparam( 'id_post', $data[ 'id_post' ] );

        $stmt -> execute();
        return ' ¡ Post Eliminado con Exito ! ';
    
    }
    static public function Usr_bajaMus( $data ) {

        $stmt = Connection :: connect() -> prepare( 'DELETE FROM musica WHERE ID_Musica = :id_musica' );

        $stmt -> bindparam( 'id_musica', $data[ 'id_musica' ] );

        $stmt -> execute();
        return ' ¡ Musica Eliminado con Exito ! ';
    }

static public function login($datos){
try {
    if ( isset( $datos[ 'Correo' ] ) && isset( $datos[ 'Password' ] ) ) {
        $pass = hash( 'sha512', $datos[ 'Password' ] );
        $stmt = Connection::connect()->prepare( 'select * from usuario where Correo=:Correo and Contraseña=:Password ' );
        $stmt->bindParam( ':Correo', $datos[ 'Correo' ] );
        $stmt->bindParam( ':Password', $pass );
        $stmt->execute();

        if ( $stmt->rowCount()>0 ) {
            $datos2 = UsuarioModel::ObtenerIDUsuario( $datos[ 'Correo' ] );

            if ( !UsuarioModel::ExisteToken( $datos2[ 'ID_Usuario' ] ) ) {

                $datos = UsuarioModel::MostrarUsuarioEspecifico( $datos[ 'Correo' ] );
                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> UsuarioModel::InsertarToken( $datos ) );
                echo json_encode( $json );
            } else {

                $datos = UsuarioModel::MostrarUsuarioEspecifico( $datos[ 'Correo' ] );

                $json = array( 'message'=>'¡Operacion Exitosa!', 'status'=>200, 'data'=> UsuarioModel::ActualizarToken( $datos ) );
                echo json_encode( $json );
            }

        } else {
            header( 'HTTP/1.0 401 Not Authorized ' );
            echo 'El Correo o la Contraseña no Coinciden!';
        }
    } else {
        header( 'HTTP/1.0 401 Not Authorized ' );
        echo 'No deje los Campos Vacios!';
    }

} catch( Exception $e1 ) {
    return 'Error'.$e1->getMessage();
}
}
//Obtiene el  ID del Usuario por medio del correo
static public function ObtenerIDUsuario( $data ) {
    try {

        $stmt = Connection::connect()->prepare( 'select ID_Usuario from Usuario where Correo=:Correo' );
        $stmt->bindParam( ':Correo', $data );
        $stmt->execute();
        if ( $stmt != null )
        return $stmt->fetch();
        return null;

    } catch( Exception $e1 ) {
        return 'Error'.$e1->getMessage();
    }

}
static public function ExisteToken( $datos ) {
    try {

        $stmt = Connection::connect()->prepare( "select token from usuariostoken where id_usuario=:ID_USUARIO and ESTATUS='A'" );
        $stmt->bindParam( ':ID_USUARIO', $datos );
        $stmt->execute();

        if ( $stmt->rowCount()>0 ) {

            return true;

        } else {
            return false;
        }
    } catch( Exception $e1 ) {
        return 'Error'.$e1->getMessage();
    }

}

 //Mostrar Usuario Especifico
 static  public function MostrarUsuarioEspecifico( $id ) {
    $stmt = Connection::connect()->prepare( 'SELECT ID_Usuario,Correo,Nombre_Usuario,Fecha_Nacimiento,Foto_Perfil,Descripcion,Followers,Following,Rol FROM usuario where Correo=:correo' );
    $stmt->bindParam( ':correo', $id );
    $stmt->execute();
    if ( $stmt != null )

    return $stmt->fetch( PDO::FETCH_ASSOC );

    return null;
    $stmt->close();
    $stmt = null;

}

static public function InsertarToken( $datos ) {
    try {

        $time = time();
        $token = array( 'message'=>'¡Operacion con Exito!', 'status'=>200, 'data'=>
        $datos );
        $jwt = JWT::encode( $token, Enviroment::getJWT_Key(), 'HS256' );

        $stmt = Connection::connect()->prepare( "insert into  usuariostoken values(:ID_USUARIO,:token,default,'A')" );

        $stmt->bindParam( ':ID_USUARIO', $datos[ 'ID_Usuario' ] );

        $stmt->bindParam( ':token', $jwt );
        $stmt->execute();
        return $jwt;
    } catch( Exception $e1 ) {
        return 'Error:'.$e1->getMessage();
    }

}

static public function ActualizarToken( $datos ) {
    try {

        $time = time();
        $token = array( 'message'=>'¡Operacion con Exito!', 'status'=>200, 'data'=>
        $datos );
        $jwt = JWT::encode( $token, Enviroment::getJWT_Key(), 'HS256' );

        $stmt = Connection::connect()->prepare( "update usuariostoken set id_usuario=:ID_USUARIO,token=:token,Estatus='A' where id_usuario=:ID_USUARIO" );
        $stmt->bindParam( ':ID_USUARIO', $datos[ 'ID_Usuario' ] );

        $stmt->bindParam( ':token', $jwt );
        $stmt->execute();
        return $jwt;
    } catch( Exception $e1 ) {
        return 'Error:'.$e1->getMessage();
    }
}

static public function registrarse($data){
    try {

        $stmt = Connection::connect()->prepare( "insert into usuario values (null,:nusu,:Correo,:Pass,:fechanac,:imagen,:desc,0,0,1,'A')");
        $stmt->bindParam( ':nusu', $data['nombre_usu']);
        $stmt->bindParam( ':Correo', $data[ 'correo' ] );
        $pass = hash( 'sha512', $data['pass'] );
        $stmt->bindParam( ':Pass', $pass );
        $stmt->bindParam( ':fechanac', $data['fecha_nac'] );
        $stmt->bindParam(':imagen',$data['img']);
        $stmt->bindParam( ':desc', $data[ 'descripcion' ] );
        $stmt->execute();
        return 'Usuario registrado correctamente';
    } catch( Exception $e1 ) {
        return 'Error:'.$e1->getMessage();

    }


}

static public function darbajausu($data){
    try {

        $stmt = Connection::connect()->prepare( "update usuario set Estatus='I' where ID_Usuario=:id");
        $stmt->bindParam( ':id', $data['id_usuario']);
        $stmt->execute();
        return 'Usuario dado de baja correctamente';
    } catch( Exception $e1 ) {
        return 'Error:'.$e1->getMessage();

    }
}

static public function comentarpost($data){

    try{
        $stmt = Connection::connect()->prepare( "insert into comentario values(null,:idpost,:idusu,:comentario,default,0,'A')");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->bindParam( ':idusu', $data['id_usuario']);
        $stmt->bindParam( ':comentario', $data['id_post']);
        $stmt->execute();
        return 'Comentario registrado correctamente';

    }catch(Exception $e){
        return 'Error:'.$e1->getMessage();
    }


}

static public function reaccionarpost($data){

try{

$stmt = Connection::connect()->prepare( "update post set reacciones=reacciones+1 where ID_Post=:idpost");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->execute();
        
        $stmt = Connection::connect()->prepare( "insert into reacciones_publicacion values (:idusu,:idpost,default)");
        $stmt->bindParam(':idusu',$data['id_usuario']);
        $stmt->bindParam(':idpost',$data['id_post']);
        $stmt->execute();
      
        return 'Reaccion registrada correctamente';

}catch(Exception $e){
    return 'Error:'.$e1->getMessage();
    
}

}


static public function reaccionarcomentario($data){

    try{
    
    $stmt = Connection::connect()->prepare( "update comentario set Reacciones=Reacciones+1 where ID_Comentario=:idcomm");
            $stmt->bindParam( ':idcomm', $data['id_comm']);
            $stmt->execute();
            
            $stmt = Connection::connect()->prepare( "insert into reacciones_comentario values (:idusu,:idcomm,default)");
            $stmt->bindParam(':idusu',$data['id_usuario']);
            $stmt->bindParam(':idcomm',$data['id_comm']);
            $stmt->execute();
          
            return 'Reaccion registrada correctamente';
    
    }catch(Exception $e){
        return 'Error:'.$e1->getMessage();
        
    }
    
    }

static public function delcomentario($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update comentario set Estatus='I' where ID_Comentario=:idcomm");
        $stmt->bindParam( ':idcomm', $data['id_comm']);
        $stmt->execute();
        return 'Comentario borrado correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e1->getMessage();
        
    }

}
static public function delreacpost($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update post set Reacciones=Reacciones-1 where ID_Post=:idpost");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->execute();
        $stmt = Connection::connect()->prepare( "delete from reacciones_publicacion where id_publicacion=:idpost and id_usuario=:idusu");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->bindParam( ':idusu', $data['id_usu']);
        $stmt->execute();
        return 'Reaccion de post borrada correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e1->getMessage();
        
    }

}
static public function delreaccomm($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update Comentario set Reacciones=Reacciones-1 where ID_Comentario=:idcomm");
        $stmt->bindParam( ':idcomm', $data['id_comm']);
        $stmt->execute();
        $stmt = Connection::connect()->prepare( "delete from reacciones_comentario where id_comentario=:idcomm and id_usuario=:idusu");
        $stmt->bindParam( ':idcomm', $data['id_comm']);
        $stmt->bindParam( ':idusu', $data['id_usu']);
        $stmt->execute();
        return 'Reaccion de comentario borrada correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e1->getMessage();
        
    }

}
static public function delpost($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update post set Estatus='I' where ID_Post=:idpost");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->execute();
        return 'Publicación borrada correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e->getMessage();
        
    }

}

}
?>