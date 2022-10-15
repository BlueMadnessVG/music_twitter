<?php

class Connection {
    //Conecta ala Base  de Datos
    static public function connect() {
        $link = new PDO( 'mysql:host=localhost;dbname=soundclon', 'root', '' );
        $link->exec( 'set names utf8' );
        return $link;
    }

}
?>