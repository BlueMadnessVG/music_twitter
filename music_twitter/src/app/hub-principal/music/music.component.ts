import { Component, OnInit } from '@angular/core';
import { MusicaUsuario } from 'src/app/modelos/musicaUsuario.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { finalize, Observable } from 'rxjs';

import { AngularFireStorage } from '@angular/fire/compat/storage'
import { categorias } from 'src/app/modelos/categorias.model';
import { guardarMusicaModel } from 'src/app/modelos/guardarMusica.model';
import { publicarPostModel } from 'src/app/modelos/publicarPost.model';
import Swal from 'sweetalert2';
@Component({
  selector: 'music',
  templateUrl: './music.component.html',
  styleUrls: ['./music.component.css']
})
export class MusicComponent implements OnInit {

  Categorias !: categorias[];
  id_music !: number
  uploadForm: FormGroup;
  imageUrl!: string;

  fileMessage = 'No hay un archivo seleccionado';
  FormData = new FormData();
  fileName = '';
  publicURL!: Observable<any>;
  url_music!: any;
  cargando:boolean = false;

  constructor( private usuarioService : UsrService, private fb : FormBuilder, private storage: AngularFireStorage) {
    this.uploadForm = this.fb.group({
      name : ['', Validators.required],
      categoria : ['', Validators.required],
      image : [null],
      musicPath : [null],
      comment : ['', Validators.required]

    });
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
    this.uploadForm.patchValue( {
      name: this.fileName
    } )

  }

  upleadMusic() {

    let file = this.FormData.get('file');
    const fileRef = this.storage.ref(this.fileName );
    const task = this.storage.upload( this.fileName, file );

    task.snapshotChanges()
    .pipe( finalize(() => {
      this.publicURL = fileRef.getDownloadURL();
      this.publicURL.subscribe( url => {
        if(url){
          this.url_music = url;
        }
        this.cargando = false;
        this.uploadForm.patchValue( {
          musicPath: this.url_music
        } )
        console.log(this.url_music);
        this.savePost();
      } );
    } ) 
    ).subscribe( url => {
      this.cargando = true;
      if(url){
        console.log(url);
      }
    } );
    
  }

  submit(){

    if( (this.imageUrl != "./assets/images/album_default.jpg") && ( this.FormData.get('file') != null ) && this.uploadForm.valid ){

      this.uploadForm.patchValue( {
        image: this.imageUrl
      } )
      
      this.upleadMusic();
    }

  }

  savePost() {

    console.log( this.uploadForm.value );
    this.usuarioService.guardarMusica(
      new guardarMusicaModel(
        JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario,
        this.uploadForm.controls['name'].value,
        this.uploadForm.controls['categoria'].value,
        this.uploadForm.controls['image'].value,
        this.uploadForm.controls['musicPath'].value,
      )
    ).subscribe( (data: any) => {
      this.id_music = data.data[0].ID_Musica;
      console.log(this.id_music);
      this.usuarioService.publicarPost(
        new publicarPostModel(
          JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario,
          this.uploadForm.controls['comment'].value,
          this.id_music
        )
      ).subscribe( (data: any) => {
        document.getElementById("btn-close-post")?.click();
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: '¡ Post Publicado con Exito !',
          showConfirmButton: false,
          timer: 1500
        })
      } )

    } )

  }



}
