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

        $stmt = Connection :: connect() -> prepare( 'INSERT INTO musica VALUES ( null, :id_usr, :nombre, :id_categoria, :id_album, :duracion, :path, "A" )' );

        $stmt -> bindparam( ':id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );
        $stmt -> bindparam( ':id_album', $data[ 'id_album' ] );
        $stmt -> bindparam( ':duracion', $data[ 'duracion' ] );
        $stmt -> bindparam( ':path', $data[ 'path' ] );

        $stmt -> execute();
        return ' ¡ Se Registro Correctamente la Musica ! ';

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

        //monstrar post por id
        if( $data != null ){

            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM post WHERE ID_Post = :id_post' );
                
            $stmt -> bindparam( ':id_post', $data[ 'id_post' ] );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

        }
        //mostrar todas las post
        else{
        
            $stmt = Connection :: connect() -> prepare( 'SELECT * FROM post' );
            $stmt -> execute();
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
        
        }

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
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
        
        }

    }

    static public function registrarUsr( $data ) {

        $stmt = Connection :: connect() -> prepare( ' INSERT INTO usuario VALUES ( null, :nombre, :correo, :PassWord, :fecha_nacimiento, :foto_perfil, :descripcion, 0, 0, :tipo, "A" ) ' );

        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':correo', $data[ 'correo' ] );
        $stmt -> bindparam( ':PassWord', $data[ 'contraseña' ] );
        $stmt -> bindparam( ':fecha_nacimiento', $data[ 'fecha_nacimiento' ] );
        $stmt -> bindparam( ':foto_perfil', $data[ 'foto_perfil' ] );
        $stmt -> bindparam( ':descripcion', $data[ 'descripcion' ] );
        $stmt -> bindparam( ':tipo', $data[ 'tipo' ] );

        $stmt -> execute();
        return '¡ Se Registro Correctamente el Usuario !';

    }

    static public function modificarUsr( $data ) {

        $stmt = Connection :: connect() -> prepare( 'UPDATE usuario SET Nombre_Usuario = :nombre, Correo = :correo, Contraseña = :PassWord, Fecha_Nacimiento = :fecha_nacimiento, Foto_Perfil = :foto_perfil, Descripcion = :descripcion, Rol = :tipo WHERE ID_Usuario = :id_usr' );

        $stmt -> bindparam( 'id_usr', $data[ 'id_usr' ] );
        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':correo', $data[ 'correo' ] );
        $pass = hash( 'sha512', $data[ 'contraseña' ] );
        $stmt -> bindparam( ':PassWord', $pass);
        $stmt -> bindparam( ':fecha_nacimiento', $data[ 'fecha_nacimiento' ] );
        $stmt -> bindparam( ':foto_perfil', $data[ 'foto_perfil' ] );
        $stmt -> bindparam( ':descripcion', $data[ 'descripcion' ] );
        $stmt -> bindparam( ':tipo', $data[ 'tipo' ] );

        $stmt -> execute();
        return '¡ Usuario Modificado Correctamente !';
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
            
            return $stmt -> fetchAll( PDO::FETCH_ASSOC );;
        
        }

    }

    static public function registrarAlb( $data ) {

        $stmt = Connection :: connect() -> prepare( ' INSERT INTO album VALUES (null, :usuario, :nombre, current_date(), :duracion, "A") ' );

        $stmt -> bindParam( ':usuario', $data[ 'usuario' ] );
        $stmt -> bindParam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindParam( ':duracion', $data[ 'duracion' ] );

        $stmt -> execute();
        return '¡ Se Registro Correctamente el Album !';

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

                $stmt = Connection :: connect() -> prepare( 'SELECT * FROM categoria WHERE ID_Categoria = :id_categoria' );
            
                $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );
                $stmt -> execute();
        
                return $stmt -> fetchAll( PDO::FETCH_ASSOC );;

        }
        //mostrar todas las categorias
        else{
                $stmt = Connection :: connect() -> prepare( 'SELECT * FROM categoria' );

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

        $stmt = Connection :: connect() -> prepare( ' UPDATE categoria SET Nombre = :nombre, Estatus = :estatus WHERE ID_Categoria = :id_categoria; ' );

        $stmt -> bindparam( ':nombre', $data[ 'nombre' ] );
        $stmt -> bindparam( ':estatus', $data[ 'estatus' ] );
        $stmt -> bindparam( ':id_categoria', $data[ 'id_categoria' ] );

        $stmt -> execute();
        return '¡ Categoria Modificada con Exito !';

    }

}




?>