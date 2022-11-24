import { Component, OnInit } from '@angular/core';
import { MusicaUsuario } from 'src/app/modelos/musicaUsuario.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { AngularFireStorage } from '@angular/fire/compat/storage'
import { categorias } from 'src/app/modelos/categorias.model';
@Component({
  selector: 'music',
  templateUrl: './music.component.html',
  styleUrls: ['./music.component.css']
})
export class MusicComponent implements OnInit {

  Categorias !: categorias[];
  imageUrl!: string;

  fileMessage = 'No hay un archivo seleccionado';
  FormData = new FormData();
  fileName = '';
  publicURL = '';
  percent = 0;
  done = false;

  constructor( private usuarioService : UsrService ) {

  }

  ngOnInit(): void {

    this.imageUrl = "./assets/images/album_default.jpg";
    this.ObtenerCategorias();

  }

  ObtenerCategorias(){

    this.usuarioService.obtenerCategorias().subscribe( (data: any) => {
      this.Categorias = data.data;
      console.log(this.Categorias);
    } )

  }

  onSelectImage( event: any ): any{
    
    const file = (event.target as HTMLInputElement).files![0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
      this.imageUrl = reader.result as string
    }
    reader.onerror = () => {
      console.log("error en la lactura de la imagen");
    }
    
    
  }

  onSelectFile( event: any ): any{
    
    this.fileMessage = `Archivo Preparado: ${ event.target.files[0].name }`;
    this.fileName = event.target.files[0].name;
    this.FormData.append( 'file', event.target.files[0], event.target.files[0].name );

    console.log(this.FormData.get('file'));
    /* this.upleadMusic(); */

  }

  upleadMusic() {

    let file = this.FormData.get('file');
    let tarea = this.usuarioService.uploadFile( this.fileName, file );
    let reference = this.usuarioService.storageReference( this.fileName );

    tarea.percentageChanges().subscribe( (process:any) => {
      this.percent = Math.round(process);
      if (this.percent == 100){

        this.done = true;
        
        reference.getDownloadURL().subscribe( (URL : any) => {
          this.publicURL = URL;
        } );
        console.log(this.publicURL);
      }
    } );


  }

}
