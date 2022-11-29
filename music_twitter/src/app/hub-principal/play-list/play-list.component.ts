import { Component, OnInit } from '@angular/core';
import { ObtenerMusicaModel } from 'src/app/modelos/ObtenerMusica.model';
import { Subscription } from 'rxjs';
import { UsrService } from 'src/app/servicios/usuario.service';
import { Musica } from 'src/app/modelos/Musica.model';
import { MusicService } from 'src/app/servicios/music.service';
import { MusicState } from 'src/app/modelos/Music.model';
import { state } from '@angular/animations';
import { ObtenerPlayListModel } from 'src/app/modelos/ObtenerPlayList.model';
import Swal from 'sweetalert2';


@Component({
  selector: 'play-list',
  templateUrl: './play-list.component.html',
  styleUrls: ['./play-list.component.css']
})
export class PlayListComponent implements OnInit {

  PlayLists!: Array<any>;
  Id_Album: number = 0;
  index: number = 0;
  files!: Array<any>;
  Selected_playlist!: number;
  subcription !: Subscription;
  aux!: number;

  constructor( private usuarioService : UsrService, private musicService: MusicService) { }

  ngOnInit(  ): void {

    this.ObtenerPlayList();
    this.subcription = this.usuarioService.refresh.subscribe( () => {
      this.ObtenerPlayList();
    } )

  }

  ngOnDestroy(): void {
    if( this.subcription ){
      this.subcription.unsubscribe();
    }
    console.log("observable cerrado");
  }

  ObtenerPlayList() {

    this.usuarioService.obtenerPlayList(
      new ObtenerPlayListModel(
        JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario
      )
    ).subscribe( (data: any) => {

      this.PlayLists = data.data;
      console.log(this.PlayLists);

    });

  }

  SelectPlayList(id_album: number){
    this.musicService.stop();
    this.musicService.MusicTrigger.emit(
      { ID_Album: id_album }
    );
  }

  SelectSong(id_album: number, index: number) {
    this.musicService.stop();
    this.musicService.MusicTrigger.emit(
      { ID_Album: id_album,
        index: index
      }
    );
  }

  ShowMusic(id_album: number) {

    this.Id_Album = id_album;
    this.aux = this.PlayLists.map( object => object.ID_Album ).indexOf(id_album);
    console.log(this.aux);

    this.usuarioService.obtenerMusica(
      new ObtenerMusicaModel(
        id_album
      )
    ).subscribe(
      (data : any) => {
          this.files = data.data;
      }
    )
  }

  Delete_PlayList( id_music: any , id_album: any ) {
    
    this.usuarioService.eliminarPlayList( 
      { id_playlist: id_album ,
        id_music: id_music}
    ).subscribe( (data) => {
      console.log( data );
      this.files = data.data;
      
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '¡ Musica Removida !',
        showConfirmButton: false,
        timer: 1500
      })

    } )

  }

}
