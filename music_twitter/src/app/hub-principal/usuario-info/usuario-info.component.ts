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
    } )

    this.subscription = this.usuarioService.refresh.subscribe( () => {

      this.ObtenerPosts( this.user_id );
      this.ObtenerReacciones();

    } )

  }

  sendid(data:any){
   

    this.usuarioService.ObtencionComentarios.emit(
      {id_post:data
      }
    );
  }

  ngOnDestroy() {

    if( this.subscription ){
      this.subscription.unsubscribe();
    }

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
      console.log(data.data);

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Musica Agregada a la playlist',
        showConfirmButton: false,
        timer: 1500
      })
    } )
  }

}
