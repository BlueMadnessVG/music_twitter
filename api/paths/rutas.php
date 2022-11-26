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

        }

         // --------------------------------------    MENSAJES    -------------------------------------- 

         else if ( array_filter( $arrayRutas )[ 2 ] == '?u=EnviarMensaje' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> enviarMensaje( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[ 2 ] == '?u=ObtenerChat' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> obtenerChat( $datosArray );

            }

        }

         // --------------------------------------    CRUD DE AMIGOS    --------------------------------------

        else if ( array_filter( $arrayRutas )[ 2 ] == '?u=ObtenerAmigos' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        
                $json = file_get_contents( 'php://input' );
        
                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> obtenerAmigos( $datosArray );
        
            }
        
        }
        
        // --------------------------------------    RUTAS PARA SERVICIOS DE ADMINS   -------------------------------------   

        // --------------------------------------    CRUD DE CATEGORIAS    -------------------------------------- 
    
        else if ( array_filter( $arrayRutas )[ 2 ] == '?u=MostrarCategoria' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> mostrarCat( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[ 2 ] == '?u=RegistrarCategoria' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objAdmin = new AdminController();//objeto de tipo controlador
                $objAdmin->registrarcat( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)
            }

        } else if ( array_filter( $arrayRutas )[ 2 ] == '?u=ModificarCategoria' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $json = file_get_contents( 'php://input' );
                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> modificarCat( $datosArray );

            }

        } 

        // --------------------------------------    CRUD DE ALBUM    --------------------------------------

        else if ( array_filter( $arrayRutas )[2] == '?u=MostrarAlbum' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> monstrarAlbum( $datosArray );
                
            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=RegistrarAlbum' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> registrarAlb( $datosArray );
                
            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=ModificarAlbum' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> modificarAlb( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=AgregarPlayList' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> agregarPlayList( $datosArray );

            }

        } 
        
        // --------------------------------------    CRUD DE USUARIOS    --------------------------------------

        else if ( array_filter( $arrayRutas )[2] == '?u=MostrarUsuarios' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> mostrarUsr( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=RegistrarUsuario' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> registrarUsr( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=ModificarUsuario' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> modificarUsr( $datosArray );

            }

        }else if ( array_filter( $arrayRutas )[2] == '?u=DarBajaUsuario' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> bajausr( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=DarAltaUsuario' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> altausr( $datosArray );

            }

        } 
        
        
        else if ( array_filter( $arrayRutas )[2] == '?u=CambiarPassWord' ) {
            
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> cambiarCont( $datosArray );

            }

        } 
        
        // --------------------------------------    CRUD DE PUBLICACIONES    --------------------------------------

        else if ( array_filter( $arrayRutas )[2] == '?u=MostrarPost' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> mostrarPost( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=RegistrarPost' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> registrarPost( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=ModificarPost' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> modificarPost( $datosArray );

            }

        } 
        
        // --------------------------------------    CRUD DE MUSICA    --------------------------------------

        else if ( array_filter( $arrayRutas )[2] == '?u=MostrarMusica' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> mostrarMus( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=RegistrarMusica' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> registrarMus( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=ModificarMusica' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new AdminController();
                $objAdmin -> modificarMus( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=obtenerMusicaPlayList' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> obtenerMusicaPlayList( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=obtenerMusicaUsuario' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                
                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> obtenerMusicaUsuario( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=obtenerUsuarioPlayList' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> obtenerUsuarioPlayList( $datosArray );

            }

        } 
        // --------------------------------------    RUTAS PARA SERVICIOS DE USUARIOS   -------------------------------------  
        
        // --------------------------------------    PUBLICACIONES    -------------------------------------
        
        else if ( array_filter( $arrayRutas )[2] == '?u=Usr_RegistrarPost' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> Usr_registrarPost( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=Usr_ModificarPost' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> Usr_modificarPost( $datosArray );

            }

        } 

        // --------------------------------------    DAR DE BAJA    --------------------------------------

        else if ( array_filter( $arrayRutas )[2] == '?u=Usr_BajaPost' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> Usr_bajaPost( $datosArray );

            }

        } else if ( array_filter( $arrayRutas )[2] == '?u=Usr_BajaMusica' ) {
 
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );

                $datosArray = json_decode( $json, true );
                $objAdmin = new UsuarioController();
                $objAdmin -> Usr_bajaMus( $datosArray );

            }

        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=Login'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->login( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=Registro'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->registrarse( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=Darbajausuario'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->darbajausu( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=ComentarPost'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->comentarpost( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=ReaccionarPost'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->reaccionarpost( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=ReaccionarComentario'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->reaccionarcomentario( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=DelComentario'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->delcomentario( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=DelReacPost'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->delreacpost( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=DelReacComm'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->delreaccomm( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        
        
        }else if(array_filter( $arrayRutas )[ 2 ] == '?u=DelPost'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

                $json = file_get_contents( 'php://input' );//metemos al json lo que se reciba en el insomnia/front

                $datosArray = json_decode( $json, true );//lo hacemos de tipo asociativo
                $objUser = new UsuarioController();//objeto de tipo controlador
                $objUser->delpost( $datosArray );//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        }
        else if(array_filter( $arrayRutas )[ 2 ] == '?u=GetUsuarios'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $objUser=new AdminController();
                $objUser->getusuarios();//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        } else if(array_filter( $arrayRutas )[ 2 ] == '?u=ModificarPWD'){
            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $json = file_get_contents('php://input');
                $datosArray = json_decode( $json, true );
                $objUser=new UsuarioController();
                
                $objUser->cambiopwd($datosArray);//mandamos a llamar al método correspondiente (en este caso
                                                        //mandamos como parametro el json asociativo)

            }
        }else if ( array_filter( $arrayRutas )[ 2 ] == '?u=EnviarCorreoBan' ) {

            if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $json=file_get_contents('php://input');
                $datosarrary=json_decode($json,true);
                $objMail = new CorreoController();
                $objMail->sendcorreoban($datosarrary);
           }
            }else if ( array_filter( $arrayRutas )[ 2 ] == '?u=EnviarCorreodesBan' ) {

                if ( isset( $_SERVER[ 'REQUEST_METHOD' ] ) && $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                    $json=file_get_contents('php://input');
                    $datosarrary=json_decode($json,true);
                    $objMail = new CorreoController();
                    $objMail->sendcorreodesban($datosarrary);
               }
    
    
              }else {
            echo 'No existe la ruta especifica!';
        }
    }
}


?>