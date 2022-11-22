import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { Form, ReactiveFormsModule } from '@angular/forms';
import { AddAlbumComponent } from './add-album/add-album.component';
import { AddMusicComponent } from './add-music/add-music.component';



@NgModule({
  declarations: [
    LoginComponent,
    SignUpComponent,
    AddAlbumComponent,
    AddMusicComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule
  ],
  exports: [
    LoginComponent,
    SignUpComponent,
    AddAlbumComponent
  ]
})

export class ModalsModule { }
