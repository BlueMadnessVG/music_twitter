import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { InicioComponent } from './inicio/inicio.component';
import { ChatAmigosComponent } from './chat-amigos/chat-amigos.component';


@NgModule({
  declarations: [
    InicioComponent,
    ChatAmigosComponent
  ],
  imports: [
    CommonModule
  ]
})
export class HubPrincipalModule { }
