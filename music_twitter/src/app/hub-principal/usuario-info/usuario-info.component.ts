import { Component, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { UsrService } from 'src/app/servicios/usuario.service';

@Component({
  selector: 'usuario-info',
  templateUrl: './usuario-info.component.html',
  styleUrls: ['./usuario-info.component.css']
})
export class UsuarioInfoComponent implements OnInit {

  user_id!: number;
  subscription!: Subscription;

  constructor( private usuarioService : UsrService ) { }

  ngOnInit(): void {
  
    this.subscription = this.usuarioService.dataSource.subscribe( (data) => {
      this.user_id = data;
      console.log(this.user_id);
      this.ObtenerInfo( this.user_id );
    } )

  }

  ngOnDestroy() {
    
    if( this.subscription ){
      this.subscription.unsubscribe();
    }

  }

  ObtenerInfo( id_usuario: number ){
    console.log("despues del onInit", id_usuario);
  }

}
