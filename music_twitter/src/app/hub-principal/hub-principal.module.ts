import { NgModule } from '@angular/core';
import {MatToolbarModule} from '@angular/material/toolbar'; 
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
import { MatButtonModule } from '@angular/material/button';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatRippleModule } from '@angular/material/core';
import {MatSliderModule} from '@angular/material/slider';
import { MusicPlayerComponent } from './music-player/music-player.component';
import { AddAlbumComponent } from '../modals/add-album/add-album.component';
import { ModalsModule } from '../modals/modals.module';
import { MatTableModule } from '@angular/material/table';
import { MatPaginatorModule } from '@angular/material/paginator';
import { HttpClientModule } from '@angular/common/http';

import { AngularFireModule } from '@angular/fire/compat';
import { environment } from 'src/environments/environment';
import { AngularFireStorageModule } from '@angular/fire/compat/storage';
import { UsuarioInfoComponent } from './usuario-info/usuario-info.component';

@NgModule({
  declarations: [
    InicioComponent,
    ChatAmigosComponent,
    FeedComponent,
    PlayListComponent,
    AmigosComponent,
    MusicPlayerComponent,
    UsuarioInfoComponent,
  ],
  imports: [
    CommonModule,
    ModalsModule,
    ReactiveFormsModule,
    AppRoutingModule,
    MatIconModule,
    MatToolbarModule,
    MatButtonModule,
    MatFormFieldModule,
    MatRippleModule,
    MatSliderModule,
    MatTableModule,
    MatPaginatorModule,
    HttpClientModule,

    AngularFireModule,
    AngularFireStorageModule,
    AngularFireModule.initializeApp(environment.firebase, "cloud")
  ]
})
export class HubPrincipalModule { }
