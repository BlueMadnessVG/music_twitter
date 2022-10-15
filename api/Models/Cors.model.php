<?php

class Cors{
    public static function useHeaders(){
        header( 'Access-Control-Allow-Origin: *' );
        header( 'Access-Control-Allow-Headers: X-API-KEY,authorization, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method' );
        header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE' );
        header( 'Allow: GET, POST, OPTIONS, PUT, DELETE' );
     
    }
}
?>