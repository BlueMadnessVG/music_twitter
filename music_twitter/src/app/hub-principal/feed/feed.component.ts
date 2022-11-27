import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { MusicState } from 'src/app/modelos/Music.model';
import { ObtenerPlayListModel } from 'src/app/modelos/ObtenerPlayList.model';
import { MusicService } from 'src/app/servicios/music.service';
import { UsrService } from 'src/app/servicios/usuario.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-feed',
  templateUrl: './feed.component.html',
  styleUrls: ['./feed.component.css']
})
export class FeedComponent implements OnInit {

  feed: boolean = true;
  user_playlists!: Array<any>;
  feed_posts!: Array<any>;
  
  currentFile: any = {};
  state: boolean = false;

  constructor( private usuarioService : UsrService, private musicService: MusicService, private route: Router ) { }

  ngOnInit(): void {

    this.ObtenerPlayList();
    this.ObtenerFeed();

  }

  ObtenerFeed() {
    console.log(this.feed);
    if( this.feed ){
      this.usuarioService.obtenerFeed().subscribe( (data) => {
        this.feed_posts = data.data;
        console.log(this.feed_posts);
      } )
    }
    else {
      this.usuarioService.obtenerFeedAmigos(
        { id_usr: JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario }
      ).subscribe( (data) => {
        this.feed_posts = data.data;
        console.log(this.feed_posts);
      } )
    }

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
  
  ShowProfile( id_usuario: number ){
    this.usuarioService.sendData(id_usuario);
    this.route.navigate(['/usuario_info']);
  }


  playStream( url: any ) {

    this.state = true;
    this.musicService.playStream( url ).subscribe( event => {} )

  }

  pause() {

    this.state = false;
    this.musicService.pause();

  }

  changeFeed() {

    if( this.feed ){
      this.feed = false;
    }
    else {
      this.feed = true;
    }

    this.ObtenerFeed();

  }

}
