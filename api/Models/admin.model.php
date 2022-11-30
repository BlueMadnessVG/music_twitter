<?php
require_once 'connection.php';

class AdminModel{

    // --------------------------------------    CRUD DE MUSICA    --------------------------------------
    
    static public function mostrarMus( $data ) {

        //monstrar post por id
        if( $data != null ){

            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM musica WHERE ID_Musica = :id_musica' );
                        
            $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
            $stmt -> execute();
                    
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
        
        }
        //mostrar todas las post
        else{
                
            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM musica' );
            $stmt -> execute();
                    
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
                
        }

    }

    static public function registrarMus( $data ) {

        $stmt = Connection :: connect() -> prepare( 'INSERT INTO musica VALUES ( null, :id_usr, :nombre, :id_cat, :img_path, :music_path, "A" )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':id_cat', $data[ 'id_cat' ] );
        $stmt -> bindparam( ':img_path', $data[ 'img_path' ] );
        $stmt -> bindparam( ':music_path', $data[ 'music_path' ] ); 
        $stmt -> execute();

        $stmt2 = Connection :: connect() -> prepare( 'SELECT ID_Musica FROM musica ORDER BY ID_Musica DESC LIMIT 1' );
        $stmt2 -> execute();

        return $stmt2 -> fetchAll( PDO::FETCH_ASSOC );

    }

    static public function modificarMus( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE musica SET Nombre = :nombre, ID_Categoria = :id_categoria, ID_Album = :id_album, Duracion = :duracion, Music_Path = :path, Estatus = :estatus WHERE ID_Musica = :id_musica' );

        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );
        $stmt -> bindparam( ':id_album', $data[ 'id_album' ] );
        $stmt -> bindparam( ':duracion', $data[ 'duracion' ] );
        $stmt -> bindparam( ':path', $data[ 'path' ] );
        $stmt -> bindparam( ':estatus', $data[ 'estatus' ] );

        $stmt -> execute();
        return ' ¡ Musica Modificada Exitosamente ! ';

    }

    // --------------------------------------    CRUD DE PUBLICACIONES    --------------------------------------

    static public function mostrarPost( $data ) {

        $stmt2 = Connection :: connect() -> prepare( 'SELECT * FROM `album` WHERE ID_Usuario = :id_usr LIMIT 1;' );
        $stmt2 -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt2 -> execute();

        $id_playlist = ($stmt2 -> fetch( PDO::FETCH_ASSOC ));

        $stmt = Connection :: connect() -> prepare( 'SELECT album_musica.ID_Album, musica.ID_Musica , musica.Nombre, musica.Img_Path, musica.Music_Path, categoria.Nombre as Nombre_cat, post.Comentario, post.Reacciones,post.ID_Post FROM `post` INNER JOIN musica INNER JOIN album_musica INNER JOIN categoria WHERE post.ID_Musica = musica.ID_Musica and musica.ID_Musica = album_musica.ID_Musica and categoria.ID_Categoria = musica.ID_Categoria and post.ID_Usuario = :id_usr and album_musica.ID_Album = :id_playlist;' );
        

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':id_playlist', $id_playlist['ID_Album'] );
        $stmt -> execute();
            
        return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

    }

    static public function registrarPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'INSERT INTO post VALUES ( null, :id_usr, :comentario, :id_musica, :id_album, 0, "A" )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':comentario', $data[ 'comentario' ] );
        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( 'id_album', $data[ 'id_album' ] );

        $stmt -> execute();
        return ' ¡ Post Publicado con Exito ! ';

    }

    static public function modificarPost( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE post SET Comentario = :comentario, ID_Musica = :id_musica, ID_Album = :id_album, Estatus = :estatus WHERE ID_Post = :id_post' );

        $stmt -> bindparam( 'id_post', $data[ 'id_post' ] );
        $stmt -> bindparam( ':comentario', $data[ 'comentario' ] );
        $stmt -> bindparam( ':id_musica', $data[ 'id_musica' ] );
        $stmt -> bindparam( 'id_album', $data[ 'id_album' ] );
        $stmt -> bindparam( 'estatus', $data[ 'estatus' ] );

        $stmt -> execute();
        return ' ¡ Post Modificado con Exito ! ';
    }

    // --------------------------------------    CRUD DE USUARIOS    --------------------------------------

    static public function mostrarUsr( $data ) {

        //monstrar usuario por id
        if( $data != null ){

            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM usuario WHERE ID_Usuario = :id_usr' );
                
            $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

        }
        //mostrar todas las usuario
        else{
        
            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM usuario' );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );
        
        }

    }

    static public function registrarUsr( $data ) {

        $stmt = Connection :: connect() -> prepare( ' INSERT INTO usuario VALUES (null,:nombre, :correo, :PassWord,null, "http://localhost/api/images/imagesusr/6382dc8fe1f6f.webp", :descripcion,1 , "A" ) ' );

        $stmt -> bindparam( ':nombre', $data[ 'nombre_usuario' ] );
        $stmt -> bindparam( ':correo', $data[ 'correo' ] );
        $pass = hash( 'sha512', $data[ 'contraseña' ] );
        $stmt -> bindparam( ':PassWord', $pass );

        $stmt -> bindparam( ':descripcion', $data[ 'descripcion' ] );
        $stmt -> execute();
        $datosUser = UsuarioModel::MostrarUsuarioEspecifico( $data[ 'correo' ] );
        self::subirTUMusica($datosUser['ID_Usuario']);
       $return= self::registrarfollow($datosUser['ID_Usuario']);
        return $return;

    }

    static private function subirTUMusica($id){
        $stmt = Connection :: connect() -> prepare( 'insert into album values (null,:id,"Tu Musica","../../../../../assets/images/album_default.jpg",default,"A")' );

        $stmt -> bindparam( ':id', $id );
        $stmt -> execute();
       self:: obtenerultimotumusica($id);
        
       

      
        return 'album registrado';
    }

    static private function obtenerultimotumusica($id){
        $stmt = Connection :: connect() -> prepare( ' select ID_Album from album where ID_Usuario=:id;' );

        $stmt -> bindparam( ':id', $id );
        $stmt -> execute();
        $album= $stmt -> fetch( PDO::FETCH_ASSOC );
        $stmt = Connection :: connect() -> prepare( ' insert into albums_usuario values(:idalbum,:id)' );
        $stmt -> bindparam( ':id', $id );
        $stmt -> bindparam( ':idalbum', $album['ID_Album'] );
        $stmt -> execute();
    }

    static private function registrarfollow($id){
        $stmt = Connection :: connect() -> prepare( ' INSERT INTO amigo VALUES (null,:id) ' );

        $stmt -> bindparam( ':id', $id );
        $stmt -> execute();
        return 'amigos registrado';
    }

    static public function modificarUsr( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE usuario SET Nombre_Usuario = :nombre, Correo = :correo, Descripcion = :descripcion WHERE ID_Usuario = :id_usr' );

        $stmt -> bindparam( 'id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':correo', $data[ 'correo' ] );
        $stmt -> bindparam( ':descripcion', $data[ 'descripcion' ] );

        $stmt -> execute();
         $datosUser = UsuarioModel::MostrarUsuarioEspecifico( $data[ 'correo' ] );

        return UsuarioModel::ActualizarToken( $datosUser );
        
    }

    static public function ModificarImgUsuario( $datos ) {

        $stmt = Connection::connect()->prepare( 'update usuario set Foto_Perfil=:img where ID_Usuario=:ID_USUARIO' );
        $stmt->bindParam( ':ID_USUARIO', $datos[ 'id_usuario' ] );
        $stmt->bindParam( ':img', $datos[ 'urlimg' ] );
        $stmt->execute();
  
        return '  Se modifico correctamente  la Imagen';
    }



    static public function cambiarCont( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE usuario SET contraseña = :PassWord WHERE ID_Usuario = :id_usr ' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $pass = hash( 'sha512', $data[ 'contraseña' ] );
        $stmt -> bindparam( ':PassWord',$pass );

        $stmt -> execute();
        return '¡ Contraseña Modificada con Exito !';

    }

    
    // --------------------------------------    CRUD DE ALBUM    --------------------------------------

    static public function mostrarAlb( $data ) {

        //monstrar album por id
        if( $data != null ){

            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM album WHERE ID_Album = :id_album' );
                
            $stmt -> bindparam( ':id_album', $data[ 'id_album' ] );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

        }
        //mostrar todas las album
        else{
        
            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM album' );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );
        
        }

    }

    static public function registrarAlb( $data ) {

        $stmt = Connection :: connect() -> prepare( ' INSERT INTO album VALUES (null, :id_usr, :nombre, :img_path, current_date(), "A") ' );

        $stmt -> bindParam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindParam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindParam( ':img_path', $data[ 'img_path' ] );
        $stmt -> execute();

        $stmtA = Connection :: connect() -> prepare( 'SELECT ID_Album FROM `album`ORDER by ID_Album DESC LIMIT 1;' );

        $stmtA -> execute();
        return $stmtA -> fetchAll( PDO::FETCH_ASSOC );

    }

    static public function modificarAlb( $data ) {

        $stmt = Connection :: connect() -> prepare( ' UPDATE album SET Nombre_Album = :nombre, Duracion = :duracion, Estatus = :estatus WHERE ID_Album = :id_album; ' );

        $stmt -> bindParam( ':id_album', $data[ 'id_album' ] );
        $stmt -> bindParam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindParam( ':duracion', $data[ 'duracion' ] );
        $stmt -> bindParam( ':estatus', $data[ 'estatus' ] );

        $stmt -> execute();
        return '¡ Album Modificado con Exito !';

    }

    // --------------------------------------    CRUD DE CATEOGIRAS    --------------------------------------

    static public function mostrarCat( $data ) {

        //monstrar categoria por id
        if( $data != null ){

                $stmt = Connection :: connect() -> prepare( 'SELECT * FROM categoria WHERE ID_Categoria = :id_categoria');
            
                $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );
                $stmt -> execute();
        
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

        }
        //mostrar todas las categorias
        else{
                $stmt = Connection :: connect() -> prepare( 'SELECT * FROM categoria WHERE Estatus = "A"'  );

                $stmt -> execute();
        
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
        }

    }

    //INSERT INTO `categoria`(`ID_Categoria`, `Nombre`, `Estatus`) VALUES (null,'backend',0)
    static public function registrarcat( $data ) {
        //prepara la sentencia sql pero no la ejecuta
        $stmt = Connection :: connect() -> prepare( 'INSERT INTO categoria VALUES (null, :nombre, "A")' );
        $stmt -> bindParam( ':nombre', $data['nombre'] );//aqui estamos diciendo, en donde encuentres :nombre, cambiamelo
                                                    //por lo que haya en el json con la cabecera 'nombre'
        $stmt -> execute();//ejecuta la sentencia
        return '¡Se Registro Correctamente la categoria!';
    }

    static public function modificarCat( $data ) {

        $stmt = Connection :: connect() -> prepare( ' UPDATE categoria SET Estatus = :estatus WHERE ID_Categoria = :id_categoria ' );

        $stmt -> bindparam( ':estatus', $data[ 'estatus' ] );
        $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );

        $stmt -> execute();
        return '¡ Categoria Modificada con Exito !';

    }

    static public function getusuarios(){
        $stmt = Connection :: connect() -> prepare( 'SELECT ID_Usuario,Nombre_Usuario,Correo,Fecha_Nacimiento,Foto_Perfil,Rol,Estatus from usuario' );
        $stmt -> execute();

        return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
    }
    static public function bajausr($datos){
        $stmt = Connection :: connect() -> prepare('update usuario set Estatus="I" where ID_Usuario=:id');
        $stmt -> bindparam( ':id', $datos[ 'ID_USUARIO' ] );
        $stmt->execute();
        return 'Usuario dado de baja correctamente.';
    }
    static public function altausr($datos){
        $stmt = Connection :: connect() -> prepare('update usuario set Estatus="A" where ID_Usuario=:id');
        $stmt -> bindparam( ':id', $datos[ 'ID_USUARIO' ] );
        $stmt->execute();
        return 'Usuario dado de baja correctamente.';
    }
}




?>