import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { InicioComponent } from './inicio/inicio.component';
import { ChatAmigosComponent } from './chat-amigos/chat-amigos.component';
import { UsrService } from 'src/app/servicios/usuario.service';
import { Form, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    InicioComponent,
    ChatAmigosComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule
  ]
})
export class HubPrincipalModule { }
