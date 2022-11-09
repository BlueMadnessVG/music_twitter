import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { InicioComponent } from './inicio/inicio.component';
import { ChatAmigosComponent } from './chat-amigos/chat-amigos.component';
import { UsrService } from 'src/app/servicios/usuario.service';
import { Router, RouterModule } from '@angular/router';
import { Form, ReactiveFormsModule } from '@angular/forms';
import { FeedComponent } from './feed/feed.component';
import { AppRoutingModule } from '../app-routing.module';
import { PlayListComponent } from './play-list/play-list.component';
import { AmigosComponent } from './amigos/amigos.component';
import { MatIconModule } from '@angular/material/icon';

@NgModule({
  declarations: [
    InicioComponent,
    ChatAmigosComponent,
    FeedComponent,
    PlayListComponent,
    AmigosComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    AppRoutingModule,
    MatIconModule
  ]
})
export class HubPrincipalModule { }
