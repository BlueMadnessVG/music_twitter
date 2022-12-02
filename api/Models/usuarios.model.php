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

    // --------------------------------------    MUSICA    --------------------------------------

    static public function obtenerMusicaPlayList( $data ){

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT musica.* FROM musica INNER JOIN album_musica WHERE album_musica.ID_Musica = musica.ID_Musica AND album_musica.ID_Album = :id_playlist;' );
            $stmt -> bindparam( ':id_playlist', $data[ 'id_playlist' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function eliminarMusicaPlaylist( $data ){

        try{

            $stmt = Connection :: connect() -> prepare( 'DELETE FROM `album_musica` WHERE `album_musica`.`ID_Album` = :id_playlist AND `album_musica`.`ID_Musica` = :id_music;' );
            $stmt -> bindparam( ':id_playlist', $data[ 'id_playlist' ] );
            $stmt -> bindparam( ':id_music', $data[ 'id_music' ] );
            $stmt -> execute();

            $stmt2 = Connection :: connect() -> prepare( 'SELECT musica.* FROM musica INNER JOIN album_musica WHERE album_musica.ID_Musica = musica.ID_Musica AND album_musica.ID_Album = :id_playlist;' );
            $stmt2 -> bindparam( ':id_playlist', $data[ 'id_playlist' ] );
            $stmt2 -> execute();

            if ( $stmt2 != null )
                return $stmt2 -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function obtenerMusicaUsuario( $data ){

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT musica.ID_Musica, musica.Nombre, musica.Img_Path, categoria.Nombre AS Nombre_categoria FROM musica INNER JOIN categoria WHERE musica.ID_Categoria = categoria.ID_Categoria and musica.ID_Usuario = :id_usr;' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function obtenerUsuarioPlayList( $data ){

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT album.*, usuario.Nombre_Usuario FROM `albums_usuario` INNER JOIN album INNER JOIN usuario WHERE albums_usuario.ID_Album = album.ID_Album AND usuario.ID_Usuario = album.ID_Usuario AND albums_usuario.ID_Usuario = :id_usr;' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function agregarPlayList( $data ){

        $stmt =  Connection :: connect() -> prepare( 'INSERT INTO albums_usuario VALUES  ( :id_playlist, :id_usr)' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':id_playlist', $data[ 'id_playlist' ] );
        
        $stmt -> execute();
        return ' ¡ Mensaje enviado con exito ! ';

    }

    static public function agregarMusicaPlayList( $data ){

        $stmt =  Connection :: connect() -> prepare( 'INSERT INTO album_musica VALUES ( :id_playlist, :id_musica)' );

        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( ':id_playlist', $data[ 'id_playlist' ] );
        
        $stmt -> execute();
        return ' ¡ Mensaje enviado con exito ! ';

    }
 
    static public function obtenerLista( $data ){
        try{
            $stmt = Connection :: connect() -> prepare( 'SELECT ID_Amigo FROM `amigo` WHERE ID_Usuario = :id_usr;' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function obtenerListaAmigos( $data ){

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT lista_amigos.ID_Amigo FROM `lista_amigos` INNER JOIN amigo WHERE lista_amigos.ID_Amigos = amigo.ID_Amigo AND amigo.ID_Usuario = :id_usr;' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function agregarAmigos( $data ){

        $stmt =  Connection :: connect() -> prepare( 'INSERT INTO lista_amigos VALUES ( :id_lista, :id_usr)' );

        $stmt -> bindparam( ':id_lista', $data[ 'id_lista' ] );
        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        
        $stmt -> execute();
        return ' ¡ Mensaje enviado con exito ! ';

    }

    static public function eliminarAmigo( $data ){

        $stmt =  Connection :: connect() -> prepare( 'DELETE FROM lista_amigos WHERE ID_Amigos = :id_lista AND ID_Amigo = :id_usr;' );

        $stmt -> bindparam( ':id_lista', $data[ 'id_lista' ] );
        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        
        $stmt -> execute();
        return ' ¡ Mensaje enviado con exito ! ';

    }

    // --------------------------------------    MENSAJES    --------------------------------------

    static public function enviarMensaje( $data ) {

        $stmt =  Connection :: connect() -> prepare( 'INSERT INTO chat VALUES  ( :id_usr, :id_amigo, :mensaje, now() )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':id_amigo', $data[ 'id_amigo' ] );
        $stmt -> bindparam( ':mensaje', $data[ 'mensaje' ] );

        $stmt -> execute();
        return ' ¡ Mensaje enviado con exito ! ';

    }

    static public function obtenerChat( $data ) {

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM chat WHERE (id_remitente = :id_usr AND id_destinatario = :id_amigo) OR (id_remitente = :id_amigo AND id_destinatario = :id_usr) ORDER BY Fecha;' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> bindparam( ':id_amigo', $data[ 'id_amigo' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function obtenerChatId( $data ) {

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT ID_Chat FROM `chat_mensaje` WHERE (ID_Usuario1 = :id_usr AND ID_Usuario2 = :id_amigo) OR (ID_Usuario1 = :id_amigo AND ID_Usuario2 = :id_usr);' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> bindparam( ':id_amigo', $data[ 'id_amigo' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    // --------------------------------------    AMIGOS    --------------------------------------

    static public function obtenerAmigos( $data ) {

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT lista_amigos.ID_Amigo, usuario.Nombre_Usuario, usuario.Descripcion, usuario.Foto_Perfil FROM lista_amigos INNER JOIN amigo INNER JOIN usuario WHERE amigo.ID_Usuario = :id_usr AND amigo.ID_Amigo = lista_amigos.ID_Amigos AND usuario.ID_Usuario = lista_amigos.ID_Amigo and usuario.Estatus="A"; ' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            if ( $stmt != null )
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );
            return null;

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    static public function infoUsuario( $data ) {

        try{

            $stmt = Connection :: connect() -> prepare( 'SELECT Nombre_Usuario, Foto_Perfil, Descripcion FROM `usuario` WHERE ID_Usuario = :id_usr; ' );
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();

            return $stmt -> fetchAll( PDO::FETCH_ASSOC );

        } catch( Exception $e1 ) {
            return 'Error'.$e1->getMessage();
        }

    }

    // --------------------------------------    PUBLICACIONES    --------------------------------------

    static public function Usr_registrarPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'INSERT INTO post VALUES ( null, :id_usr, :comment, :id_music, 0, "A" )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':comment', $data[ 'comment' ] );
        $stmt -> bindparam( ':id_music', $data[ 'id_music' ] );
        $stmt -> execute();

        $stmt2 = Connection :: connect() -> prepare( 'SELECT * FROM `album` WHERE ID_Usuario = :id_usr LIMIT 1;' );
        $stmt2 -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt2 -> execute();

        $id_playlist = ($stmt2 -> fetch( PDO::FETCH_ASSOC ));

        $stmt3 = Connection :: connect() -> prepare( 'INSERT INTO album_musica VALUES ( :id_playlist, :id_music )' );
        $stmt3 -> bindparam( ':id_music', $data[ 'id_music' ] );
        $stmt3 -> bindparam( ':id_playlist', $id_playlist['ID_Album'] );
        $stmt3 -> execute();

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

    static public function obtenerFeed( $data ) {

        $stmt = Connection :: connect() -> prepare( 'SELECT musica.ID_Musica, usuario.ID_Usuario, usuario.Foto_Perfil, usuario.Nombre_Usuario, musica.Nombre , musica.Img_Path, musica.Music_Path, categoria.Nombre AS Nombre_cat, post.Comentario, post.Reacciones,post.ID_Post FROM `post` INNER JOIN musica INNER JOIN categoria INNER JOIN usuario WHERE post.ID_Musica = musica.ID_Musica AND musica.ID_Categoria = categoria.ID_Categoria AND usuario.ID_Usuario = post.ID_Usuario and usuario.Estatus="A" ORDER BY RAND() DESC LIMIT 50;' );
        $stmt -> execute();

            if ( $stmt != null )
                return $stmt->fetchAll( PDO::FETCH_ASSOC );
        return null;
    }

    static public function obtenerReacciones( $data ) {

        $stmt = Connection :: connect() -> prepare( 'SELECT id_publicacion FROM `reacciones_publicacion` WHERE id_usuario = :id_usr;' );
        $stmt -> bindparam( 'id_usr', $data[ 'id_usr' ] );
        $stmt -> execute();

            if ( $stmt != null )
                return $stmt->fetchAll( PDO::FETCH_ASSOC );
        return null;
    }

    static public function obtenerFeedAmigos( $data ) {

        $stmt = Connection :: connect() -> prepare( 'SELECT musica.ID_Musica, usuario.ID_Usuario, usuario.Foto_Perfil, usuario.Nombre_Usuario, musica.Nombre , musica.Img_Path, musica.Music_Path, categoria.Nombre AS Nombre_cat, post.Comentario, post.Reacciones,post.ID_Post FROM `post` INNER JOIN musica INNER JOIN categoria INNER JOIN usuario INNER JOIN amigo INNER JOIN lista_amigos WHERE post.ID_Musica = musica.ID_Musica AND musica.ID_Categoria = categoria.ID_Categoria AND usuario.ID_Usuario = post.ID_Usuario AND lista_amigos.ID_Amigo = amigo.ID_Amigo AND amigo.ID_Usuario = :id_usr AND usuario.ID_Usuario != :id_usr LIMIT 50;' );
        $stmt -> bindparam( 'id_usr', $data[ 'id_usr' ] );
        $stmt -> execute();

        if ( $stmt != null )
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        return null;
    }

    // --------------------------------------    DAR DE BAJA    --------------------------------------

    static public function Usr_bajaPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE post SET estatus = "I" WHERE ID_Post = :id_post' );

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
    if ( isset( $datos[ 'Correo' ] ) && isset( $datos[ 'Pass' ] ) ) {
        $pass = hash( 'sha512', $datos[ 'Pass' ] );
        $stmt = Connection::connect()->prepare( 'select * from usuario where Correo=:Correo and Contraseña=:Password and Estatus="A"' );
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
            return 'Cuenta inhabilitada o inexsistente, intentelo de nuevo';
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
    $stmt = Connection::connect()->prepare( 'SELECT ID_Usuario,Correo,Nombre_Usuario,Fecha_Nacimiento,Foto_Perfil,Descripcion,Rol FROM usuario where Correo=:correo' );
    $stmt->bindParam( ':correo', $id );
    $stmt->execute();
    if ( $stmt != null )

    return $stmt->fetch( PDO::FETCH_ASSOC );

    return null;
   
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
        $stmt->bindParam( ':comentario', $data['comentario']);
        $stmt->execute();
        return 'Comentario registrado correctamente';

    }catch(Exception $e){
        return 'Error:'.$e->getMessage();
    }


}

static public function reaccionarpost($data){

try{

$stmt = Connection::connect()->prepare( "update post set Reacciones=reacciones+1 where ID_Post=:idpost");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->execute();
        
        $stmt = Connection::connect()->prepare( "insert into reacciones_publicacion values (:idusu,:idpost,default)");
        $stmt->bindParam(':idusu',$data['id_usuario']);
        $stmt->bindParam(':idpost',$data['id_post']);
        $stmt->execute();
      
        return 'Reaccion registrada correctamente';

}catch(Exception $e){
    return 'Error:'.$e->getMessage();
    
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
        return 'Error:'.$e->getMessage();
        
    }
    
    }

static public function delcomentario($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update comentario set Estatus='I' where ID_Comentario=:idcomm");
        $stmt->bindParam( ':idcomm', $data['id_comm']);
        $stmt->execute();
        return 'Comentario borrado correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e->getMessage();
        
    }

}
static public function delreacpost($data){
    
    try{
        $stmt = Connection::connect()->prepare( "update post set Reacciones=Reacciones-1 where ID_Post=:idpost");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->execute();
        $stmt = Connection::connect()->prepare( "delete from reacciones_publicacion where id_publicacion=:idpost and id_usuario=:idusu");
        $stmt->bindParam( ':idpost', $data['id_post']);
        $stmt->bindParam( ':idusu', $data['id_usuario']);
        $stmt->execute();
        return 'Reaccion de post borrada correctamente';
        
    }catch(Exception $e){
        return 'Error:'.$e->getMessage();
        
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
        return 'Error:'.$e->getMessage();
        
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

static public function veroldpwd($datos){
    $pass = hash( 'sha512', $datos[ 'Passold' ] );
    $stmt = Connection::connect()->prepare( "select * from usuario where ID_Usuario=:id_usuario and Contraseña=:Password and Estatus='A' " );
    $stmt->bindParam( ':id_usuario', $datos[ 'ID_USUARIO' ] );
    $stmt->bindParam( ':Password', $pass );
    $stmt->execute();
    if ( $stmt->rowCount()>0 ) 
    return true;
    return false;
}

static public function Modpwd( $data ) {
    $stmt = Connection::connect()->prepare( 'update usuario set Contraseña=:pass where ID_Usuario=:ID_USUARIO' );
    $stmt->bindParam( ':ID_USUARIO', $data[ 'ID_USUARIO' ] );
    $pass = hash( 'sha512', $data[ 'Pass' ] );
    $stmt->bindParam( ':pass', $pass );
    $stmt->execute();
    return '¡Se Modifico Correctamente la Contraseña!';
}

static public function getcomentarios( $data ) {
    
    $stmt = Connection :: connect() -> prepare( 'select Comentario,fecha_comentario,usuario.Nombre_Usuario,usuario.Foto_Perfil from comentario inner join usuario where comentario.id_usuario=usuario.ID_Usuario and Comentario.ID_Publicacion=:id_post order by comentario.fecha_comentario desc' );
    $stmt->bindParam(':id_post',$data['id_post']);
    $stmt -> execute();

        if ( $stmt != null )
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
    return "¡error al obtener los comentarios...";
}



}
?>