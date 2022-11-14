import { Component, OnInit } from '@angular/core';
import { ObtenerMusicaModel } from 'src/app/modelos/ObtenerMusica.model';
import { Subscription } from 'rxjs';
import { UsrService } from 'src/app/servicios/usuario.service';
import { Musica } from 'src/app/modelos/Musica.model';


@Component({
  selector: 'play-list',
  templateUrl: './play-list.component.html',
  styleUrls: ['./play-list.component.css']
})
export class PlayListComponent implements OnInit {

  audio = new Audio();
  audioState!: boolean;
  musica!: Musica[];

  subcription !: Subscription;

  constructor( private usuarioService : UsrService ) { 
    this.audioState = false;
  }

  ngOnInit(): void {

    this.ObtenerMusica();


  }

  ObtenerMusica() {

    this.usuarioService.obtenerMusica(
      new ObtenerMusicaModel(
        3
      )
    ).subscribe(
      (data : any) => {
          this.musica = data.data;
          console.log("jalo wey ", this.musica[0].Img_Path);
          this.audio.src = this.musica[0].Music_Path;
          this.audio.load();
      }
    )

  }

  playSound(){

    this.audio.play();
    this.audioState = true;

  }

  pauseSound() {

    this.audioState = false;
    this.audio.pause();

  }

  resumeSound() {

    this.audioState = false;
    this.audio.play();

  }



}
