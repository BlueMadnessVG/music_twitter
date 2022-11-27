import { Component, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { MusicService } from 'src/app/servicios/music.service';
import { UsrService } from 'src/app/servicios/usuario.service';

@Component({
  selector: 'usuario-info',
  templateUrl: './usuario-info.component.html',
  styleUrls: ['./usuario-info.component.css']
})
export class UsuarioInfoComponent implements OnInit {

  user_id!: number;
  subscription!: Subscription;
  user_info!: any;
  user_posts!: Array<any>;
  reaccion!: boolean;

  constructor( private usuarioService : UsrService, private musicService: MusicService ) { }

  ngOnInit(): void {
  
    this.subscription = this.usuarioService.dataSource.subscribe( (data) => {

      if( data != 0 ){
        this.user_id = data;
      }else{
        this.user_id = JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario;
      }
      
      this.ObtenerInfo( this.user_id );
    } )

  }

  ngOnDestroy() {
    
    if( this.subscription ){
      this.subscription.unsubscribe();
    }

  }

  ObtenerInfo( id_usuario: number ){
    
    this.usuarioService.obtnerInfoUsuario(
      { id_usr: id_usuario}
    ).subscribe( (data) =>{

      this.user_info = data.data;
      console.log(this.user_info[0]);
      this.ObtenerPosts( id_usuario );

    } )

  }

  ObtenerPosts( id_usuario: number ){

    this.usuarioService.obtenerPosts( 
      { id_usr: id_usuario }
    ).subscribe( (data) => {

      this.user_posts = data.data;
      console.log(this.user_posts);

    } )

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

}
