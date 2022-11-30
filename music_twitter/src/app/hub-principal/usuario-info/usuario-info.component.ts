import { Component, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { ObtenerPlayListModel } from 'src/app/modelos/ObtenerPlayList.model';
import { MusicService } from 'src/app/servicios/music.service';
import { UsrService } from 'src/app/servicios/usuario.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'usuario-info',
  templateUrl: './usuario-info.component.html',
  styleUrls: ['./usuario-info.component.css']
})
export class UsuarioInfoComponent implements OnInit {

  user_id!: number;
  subscription!: Subscription;
  user_reactions!: Array<any>;
  user_info!: any;
  user_posts!: Array<any>;
  reaccion!: boolean;
  user_playlists!: Array<any>;
  comentarios!:Array<any>;
  lista_amigos!: Array<any>;
  id_lista!: any;

  agregar_amigo: boolean = false;

  constructor( private usuarioService : UsrService, private musicService: MusicService ) { }

  ngOnInit(): void {

    this.subscription = this.usuarioService.dataSource.subscribe( (data) => {

      if( data != 0 ){
        this.user_id = data;
      }else{
        this.user_id = JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario;
      }
      this.ObtenerReacciones();
      this.ObtenerInfo( this.user_id );
      this.ObtenerPlayList();

      if( this.user_id !=  JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario ) {
        this.agregar_amigo = true;
        this.ObtenerLista();
        this.ObtenerListaAmigos();
      }

    } )

    this.subscription = this.usuarioService.refresh.subscribe( () => {

      this.ObtenerPosts( this.user_id );
      this.ObtenerReacciones();

    } )

  }

  ngOnDestroy() {
    console.log("entro aqui");
    if( this.subscription ){
      this.subscription.unsubscribe();
    }

  }

  sendid(data:any){
    this.usuarioService.ObtencionComentarios.emit(
      {id_post:data
      }
    );
  }
  quitarlike(id_post:any){
    this.usuarioService.quitarlike({
      id_post:id_post,
      id_usuario:JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario
    }).subscribe((x)=>{

      this.ObtenerReacciones();
      this.isReacted(id_post);
      this.user_posts[ this.user_posts.map( object => object.ID_Post ).indexOf(id_post) ].Reacciones =  Number(this.user_posts[ this.user_posts.map( object => object.ID_Post ).indexOf(id_post) ].Reacciones) - 1;

    })
  }
  ponerlike(id_post:any){
    this.usuarioService.ponerlike({
      id_post:id_post,
      id_usuario:JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario
    }).subscribe((x)=>{

      this.ObtenerReacciones();
      this.isReacted(id_post);
      this.user_posts[ this.user_posts.map( object => object.ID_Post ).indexOf(id_post) ].Reacciones =  Number(this.user_posts[ this.user_posts.map( object => object.ID_Post ).indexOf(id_post) ].Reacciones) + 1;

    })
  }

  ObtenerInfo( id_usuario: number ){

    this.usuarioService.obtnerInfoUsuario(
      { id_usr: id_usuario }
    ).subscribe( (data) =>{

      this.user_info = data.data;
      console.log(this.user_info[0]);
      this.ObtenerPosts( id_usuario );

      

    } )

  }

  ObtenerLista() {

    this.usuarioService.obtenerLista( 
      { id_usr: JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario } 
    ).subscribe( (data) => {

      this.id_lista = data.data[0];
      console.log( "lista", this.id_lista["ID_Amigo"] );

    } )

  }

  ObtenerListaAmigos() {

    this.usuarioService.obtenerListaAmgios(
      { id_usr: JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario }
    ).subscribe( (data) => {

      this.lista_amigos = data.data;
      console.log("hola", data.data);

    } )

  }

  isFollowing( ) {
    return this.lista_amigos.some( x => x.ID_Amigo === this.user_id );
  }

  ObtenerPlayList() {

    this.usuarioService.obtenerPlayList(
      new ObtenerPlayListModel(
        JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario
      )
    ).subscribe( (data: any) => {

      this.user_playlists = data.data;
      this.user_playlists.shift();
      console.log(this.user_playlists);

    });

  }

  ObtenerPosts( id_usuario: number ){
    this.usuarioService.obtenerPosts(
      { id_usr: id_usuario }
    ).subscribe( (data) => {

      this.user_posts = data.data;
      console.log(this.user_posts);

    } )

  }

  ObtenerReacciones() {

    this.usuarioService.obtenerReacciones(
      { id_usr: JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario }
    ).subscribe( (data) => {
      this.user_reactions = data.data;
    } )

  }

  isReacted( id_post: string ) {
    return this.user_reactions.some( x => x.id_publicacion === id_post );
  }

  SelectSong(id_album: number, index: number) {
    this.musicService.stop();
    this.musicService.MusicTrigger.emit(
      {
        ID_Album: id_album,
        index: index
      }
    );
  }

  addPlayList( id_album: number, id_music: number ){
    console.log("album: ", id_album, "musica: ", id_music);

    this.usuarioService.agregarMusicaPlaylist(
      {
        id_playlist: id_album,
        id_musica: id_music
      }
    ).subscribe( (data) => {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Musica Agregada a la playlist',
        showConfirmButton: false,
        timer: 1500
      })
    }, ( error ) => {
      Swal.fire({
        position: 'top-end',
        title: 'La musica ya esta agregada en la playlist',
        icon: 'warning',
        showConfirmButton: false,
        timer: 1500
      })
    } )
  }

  AddFollow() {

    this.usuarioService.AgregarAmigo( 
      { id_lista: this.id_lista["ID_Amigo"] ,
        id_usr: this.user_id }
    ).subscribe( (data) => {

      this.ObtenerListaAmigos();

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Usuario Agregado',
        showConfirmButton: false,
        timer: 1500
      })
    }, ( error ) => {
      Swal.fire({
        position: 'top-end',
        title: 'Hubo un error, intente de nuevo mas tarde',
        icon: 'warning',
        showConfirmButton: false,
        timer: 1500
      })

    } )

  }

  DeleteFollow() {

    this.usuarioService.EliminarAmigo( 
      { id_lista: this.id_lista["ID_Amigo"],
        id_usr: this.user_id }
    ).subscribe( (data) => {

      this.ObtenerListaAmigos();

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Usuario eliminado',
        showConfirmButton: false,
        timer: 1500
      })
    }, ( error ) => {
      Swal.fire({
        position: 'top-end',
        title: 'Hubo un error, intente de nuevo mas tarde',
        icon: 'warning',
        showConfirmButton: false,
        timer: 1500
      })

    } )

  }

}
