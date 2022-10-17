<?php
require_once 'Connection.php';

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

}



?>