import { Component, OnInit } from '@angular/core';
import { MusicaUsuario } from 'src/app/modelos/musicaUsuario.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import { agregarMusicaModel } from 'src/app/modelos/AgregarMusicaModel.model';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { AngularFireStorage } from '@angular/fire/compat/storage'

@Component({
  selector: 'music',
  templateUrl: './music.component.html',
  styleUrls: ['./music.component.css']
})
export class MusicComponent implements OnInit {


  dataSource!: MusicaUsuario[];
  displayedColumns: string[] = [ 'Nombre', 'Nombre_Album', 'Nombre_categoria'];
  public file!: File;
  downloadURL!: Observable<string>;

  constructor( private usuarioService : UsrService, private storage: AngularFireStorage ) {

  }

  ngOnInit(): void {


    this.ObtenerMusicaUsuario();

  }

  ObtenerMusicaUsuario() {

    this.usuarioService.obtenerMusicaUsuario(
      {id_usr: JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario }
    ).subscribe( (data: any) => {

      this.dataSource = data.data;

    } );

  }

  onSelectFile( event: any ): any{
    
    var n = Date.now();
    const file = event.target.files[0];
    const filePath = `Music/${n}`

  }

  upleadMusic() {

    

  }

}
