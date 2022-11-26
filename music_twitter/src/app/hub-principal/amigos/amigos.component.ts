import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { right } from '@popperjs/core';
import { ObtenerAmigosModel } from 'src/app/modelos/ObtenerAmigos.model';
import { UsrService } from 'src/app/servicios/usuario.service';

@Component({
  selector: 'app-amigos',
  templateUrl: './amigos.component.html',
  styleUrls: ['./amigos.component.css']
})
export class AmigosComponent implements OnInit {

  Friends!: Array<any>;

  constructor( private usuarioService: UsrService, private route: Router ) { }

  ngOnInit(): void {

    this.ObtenerAmigosModel();

  }

  ObtenerAmigosModel(){

    this.usuarioService.obtenerAmigos(
      new ObtenerAmigosModel(
        JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario
      )
    ).subscribe( (data: any) => {

      this.Friends = data.data;
      console.log(this.Friends);

    });

  }

  ShowFriend( id_usuario: number ){
    this.usuarioService.sendData(id_usuario);
    this.route.navigate(['/usuario_info']);
  }

}
