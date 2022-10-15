<?php
$arrayRutas = explode( '/', $_SERVER[ 'REQUEST_URI' ] );//este arreglo tiene la url de la api
//Separa la ruta actual y lo guarda en un array
if ( count( array_filter( $arrayRutas ) ) == 1 ) {//EJ localhost/api
    //Caso que no exista una ruta
    echo 'Ruta no Encontrada';
    return;

} else {
    //Sin Parametros
    if ( count( array_filter( $arrayRutas ) ) == 2 )// ej. localhost/api/?u=pruebaget
 {

        if ( array_filter( $arrayRutas )[ 2 ] == '?u=pruebaget' ) {
            //Post en Alumnos
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $objUsuarios = new UsuarioController();//se crea un nuevo objeto de tipo controlador
                $objUsuarios->pruebaget();//mandamos a llamar al metodo de esta url

            }

        } else if ( array_filter( $arrayRutas )[ 2 ] == '?u=RegistrarCategoria' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objAdmin = new AdminController();//objeto de tipo controlador
                $objAdmin->registrarcat( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }

        }else {
            echo 'No existe la ruta especifica!';
            echo ($arrayRutas);
        }
    }

}




?>