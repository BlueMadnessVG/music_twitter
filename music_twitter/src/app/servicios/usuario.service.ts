import { HttpClient } from "@angular/common/http";
import { EventEmitter, Injectable, Output } from "@angular/core";
import { JwtHelperService } from "@auth0/angular-jwt";
import { BehaviorSubject, Observable, Subject, tap } from 'rxjs';

import { AngularFireStorage } from "@angular/fire/compat/storage";

/* Modelos */
import { TUsuario } from "../modelos/TUsuario.model";
import { TAmigos } from "../modelos/TAmigos.model";
import { TMusica } from "../modelos/TMusica.model";
import { ObtenerPlayListModel } from "../modelos/ObtenerPlayList.model";
import { TPlayList } from "../modelos/TPlayList.model";
import { TCrearPlayList } from "../modelos/TCrearPlayList.model";
import { crearPlayListModel } from "../modelos/CrearPlayList.model";
import { JsonPipe } from "@angular/common";
import { agregarPlayListModel } from "../modelos/agregarPlayList.model";
import { TMusicaUsuario } from "../modelos/TMusicaUsuario.model";
import { TCategorias } from "../modelos/TCategorias.model";
import { LoginModel } from "../modelos/Login.model";
import { EnviarMensajeModel } from "../modelos/EnviarMensaje.model";
import { ObtenerChatModel } from "../modelos/ObtenerChat.model";
import { ObtenerMusicaModel } from "../modelos/ObtenerMusica.model";
import { ObtenerAmigosModel } from "../modelos/ObtenerAmigos.model";
import { TObtenerCategorias } from "../modelos/TObternerCategorias.model";
import { guardarMusicaModel } from "../modelos/guardarMusica.model";
import { publicarPostModel } from "../modelos/publicarPost.model";
import { TInfoUsuario } from "../modelos/TInfoUsuario.model";
import { TObtenerPosts } from "../modelos/TObtenerPosts.model";
import { TAgregarMusicaPlaylist } from "../modelos/TAgregarMusicaPlayList.model";
import { TObtenerFeed } from "../modelos/TObtenerFeed.model";
@Injectable( {

    providedIn: 'root',

})

export class UsrService {

    urlApi: string = 'http://localhost/api/';
    private _refresh$ = new Subject <void> ();
    get refresh() {
        return this._refresh$;
    }

    constructor( private client: HttpClient, private storage: AngularFireStorage ) { }

    //Upload file
    uploadFile( fileName: string, data: any ) {
      return this.storage.upload(fileName, data);
    }

    storageReference( fileName: string ) {
      return this.storage.ref( fileName );
    }

    AmigosUsr(): Observable <TUsuario> {

        return this.client.post<TUsuario>(this.urlApi + '?u=MostrarUsuarios', null).pipe(
            tap(()=> {
                this.refresh.next();
            })
        );

    }

    enviarMensaje( data: EnviarMensajeModel ): Observable < TUsuario > {

      return this.client.post< TUsuario >(
        this.urlApi + '?u=EnviarMensaje',
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )
      .pipe(
          tap( () => {
            this.refresh.next();
          } )
       );

    }

  /* servicios del chat */
    obtenerChat(data: ObtenerChatModel ): Observable < TUsuario > {

      return this.client.post< TUsuario > (
        this.urlApi + '?u=ObtenerChat',
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      );

    };

    obtenerAmigos(data: ObtenerAmigosModel): Observable < TAmigos > {

      return this.client.post< TAmigos > (
        this.urlApi + "?u=ObtenerAmigos",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    };
  /* servicios del chat */

  /* servicios de musica */

    obtenerMusica(data: ObtenerMusicaModel): Observable < TMusica > {

      return this.client.post< TMusica > (
        this.urlApi + "?u=obtenerMusicaPlayList",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    obtenerMusicaUsuario(data: any): Observable < TMusicaUsuario > {

      return this.client.post< TMusicaUsuario > (
        this.urlApi + "?u=obtenerMusicaUsuario",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    obtenerPlayList( data: ObtenerPlayListModel ): Observable < TPlayList > {

      return this.client.post< TPlayList > (
        this.urlApi + "?u=obtenerUsuarioPlayList ",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    agregarPlayList( data: agregarPlayListModel ) : Observable < TPlayList > {

      return this.client.post< TPlayList > (
        this.urlApi + "?u=AgregarPlayList",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      ).pipe(
        tap( () => {
          this.refresh.next();
        } )
     );

    }

    crearPlayList( data: crearPlayListModel ) : Observable < TCrearPlayList > {

      return this.client.post< TCrearPlayList > (
        this.urlApi + "?u=RegistrarAlbum",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    obtenerCategorias() : Observable < TObtenerCategorias > {

      return this.client.post < TObtenerCategorias > (
        this.urlApi + "?u=MostrarCategoria",
        null
      )

    }

    guardarMusica( data : guardarMusicaModel ) : Observable < TMusica > {
      return this.client.post < TMusica > (
        this.urlApi + "?u=RegistrarMusica",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    publicarPost( data: publicarPostModel ) : Observable < any > {
      return this.client.post < any > (
        this.urlApi + "?u=Usr_RegistrarPost",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      ).pipe(
        tap( () => {
          this.refresh.next();
        } )
     );
    }

  /* servicios de musica */

  /* servicios de usuario */

    public dataSource = new BehaviorSubject< number >( 0 );

    sendData( data: number ){
      this.dataSource.next(data);
    }

    obtnerInfoUsuario( data: any ) : Observable < TInfoUsuario > {
      return this.client.post < TInfoUsuario > (
        this.urlApi + "?u=ObtenerInfoUsuario",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )

    }

    obtenerPosts( data: any ) :Observable < TObtenerPosts > {
      return this.client.post < TObtenerPosts > (
        this.urlApi + "?u=MostrarPost",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )
    }

    obtenerFeed(  ) : Observable < TObtenerFeed > {
      return this.client.post < TObtenerFeed > (
        this.urlApi + "?u=ObtenerFeed",
        ''
      )
    }

    obtenerFeedAmigos( data: any ) : Observable < TObtenerFeed > {
      return this.client.post < TObtenerFeed > (
        this.urlApi + "?u=ObtenerFeedAmigos",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )
    }

    agregarMusicaPlaylist( data: any ) : Observable < TAgregarMusicaPlaylist > {
      console.log(data);
      return this.client.post < TAgregarMusicaPlaylist > (
        this.urlApi + "?u=AgregarMusicaPlayList",
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      )
    }

  /* servicios de usuario */

    //Servicio para Login , Regresa un Token
    login(data: LoginModel): Observable<TUsuario> {

      return this.client.post<TUsuario>(
        this.urlApi + '?u=Login',
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      );
    }

    saveToken(data: any) {
      localStorage.setItem('token', data);
      const helper = new JwtHelperService();
      localStorage.setItem('data', JSON.stringify(helper.decodeToken(data)));
    }

    cambiopwd(data:any):Observable<TUsuario>{
      return this.client.post<TUsuario>(
        this.urlApi+'?u=ModificarPWD',JSON.stringify(data)
      );
    }

    islogin(){
      return localStorage.getItem("token")!=null;
    }


    getcategorias():Observable<TCategorias>{
      return this.client.post<TCategorias>(
        this.urlApi+'?u=pruebaget',null
      ).pipe(
        tap(()=> {
            this.refresh.next();
        })
    );
    }
    registrarse(data:any): Observable<TUsuario> {

      return this.client.post<TUsuario>(
        this.urlApi + '?u=RegistrarUsuario',
        JSON.stringify(data),
        { headers: { 'Content-Type': 'application/json' } }
      );
    }


}
