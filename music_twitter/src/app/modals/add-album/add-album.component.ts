import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UsrService } from 'src/app/servicios/usuario.service';
import { crearPlayListModel } from 'src/app/modelos/CrearPlayList.model';
import { agregarPlayListModel } from 'src/app/modelos/agregarPlayList.model';

@Component({
  selector: 'add-album',
  templateUrl: './add-album.component.html',
  styleUrls: ['./add-album.component.css']
})
export class AddAlbumComponent implements OnInit {

  imageUrl_Album: string;
  uploadForm: FormGroup;

  constructor( private fb: FormBuilder, private usuarioService : UsrService ) {

    this.imageUrl_Album = "./assets/images/album_default.jpg";
    this.uploadForm = this.fb.group({
      image : [null],
      name : ['', Validators.required]
    });

  }

  ngOnInit(): void {  }

  onSelectFile( event: any ): any{
    
    const file = (event.target as HTMLInputElement).files![0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
      this.imageUrl_Album = reader.result as string;
    }
    reader.onerror = () => {
      console.log("error en la lactura de la imagen");
    }
    
    
  }

  submit(){
    

    if( this.imageUrl_Album != "./assets/images/album_default.jpg" ) {

      this.uploadForm.patchValue( {
        image: this.imageUrl_Album
      } )

      console.log( this.uploadForm.value );


      if( this.uploadForm.valid ) {
        this.usuarioService.crearPlayList(
          new crearPlayListModel(
            JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario, 
            this.uploadForm.controls['name'].value,
            this.uploadForm.controls['image'].value,
          )
        ).subscribe( (data: any) => {
          
          console.log(data.data[0].ID_Album);

          this.usuarioService.agregarPlayList(
            new agregarPlayListModel(
              JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario,
              data.data[0].ID_Album
            )
          ).subscribe ((data:any) => {
            console.log(data);
          })
  
        } )
      }
    }
    
  }

}
