import { Component, OnInit } from '@angular/core';
import { ObtenerMusicaModel } from 'src/app/modelos/ObtenerMusica.model';
import { Subscription } from 'rxjs';
import { UsrService } from 'src/app/servicios/usuario.service';
import { Musica } from 'src/app/modelos/Musica.model';
import { MusicService } from 'src/app/servicios/music.service';
import { MusicState } from 'src/app/modelos/Music.model';
import { state } from '@angular/animations';

@Component({
  selector: 'music-player',
  templateUrl: './music-player.component.html',
  styleUrls: ['./music-player.component.css']
})
export class MusicPlayerComponent implements OnInit {

  files!: Array<any>;
  state!: MusicState;
  index!: number;
  currentFile: any = {};
  subcription !: Subscription;

  constructor( private usuarioService : UsrService, private musicService: MusicService ) { }

  ngOnInit(  ): void {

    this.ObtenerMusica();

    if( !this.files?.length ) {

      this.musicService.getState().subscribe( (state: any) => {
        
        this.index = 0;
        this.state = state;
  
      }) 
    }

    this.subcription = this.usuarioService.refresh.subscribe( () => {
      this.ObtenerMusica();
  } )

  }

  ngOnDestroy(): void {
    this.subcription.unsubscribe();
    console.log("observable cerrado");
  }

  ObtenerMusica() {

    this.usuarioService.obtenerMusica(
      new ObtenerMusicaModel(
        1
      )
    ).subscribe(
      (data : any) => {
          this.files = data.data;

          if( this.files.length ) {
            this.openFile( this.files[0], this.index );
          }
      }
    )

  }

  playStream( url: any ) {

    this.musicService.playStream( url ).subscribe( event => {} )

  }

  openFile( file: any, index: any ){

    this.currentFile = { index, file };
    this.musicService.stop();
    this.playStream( file.Music_Path );

  }

  play() {

    this.musicService.play();

  }

  pause() {

    this.musicService.pause();

  }

  stop() {

    this.musicService.stop();

  }

  next() {

    const index = this.currentFile.index + 1;
    const file = this.files[index];
    this.openFile(file, index);

  }

  previous() {
    const index = this.currentFile.index - 1;
    const file = this.files[index];
    this.openFile(file, index);
  }

  isFirstPlaying() {
    return this.currentFile.index === 0;
  }

  isLastPlaying() {
    return this.currentFile.index === this.files.length - 1;
  }

  onSliderChangeEnd(change: any) {
    this.musicService.seekTo(change.value);
  }

}
