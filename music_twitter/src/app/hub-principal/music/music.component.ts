import { Component, OnInit } from '@angular/core';
import { MusicaUsuario } from 'src/app/modelos/musicaUsuario.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import { agregarMusicaModel } from 'src/app/modelos/AgregarMusicaModel.model';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'music',
  templateUrl: './music.component.html',
  styleUrls: ['./music.component.css']
})
export class MusicComponent implements OnInit {


  dataSource!: MusicaUsuario[];
  displayedColumns: string[] = [ 'Nombre', 'Nombre_Album', 'Nombre_categoria'];
  public file : any = {};

  constructor( private fb: FormBuilder, private usuarioService : UsrService, private http: HttpClient) {

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
    
    this.file = event.target.files[0];
    this.upleadMusic();

  }

  upleadMusic() {

    

  }

}
