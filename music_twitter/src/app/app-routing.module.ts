import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CambioPwdComponent } from './cambio-pwd/cambio-pwd.component';
import { GestionPostsComponent } from './gestion-posts/gestion-posts.component';
import { GestionUsuariosComponent } from './gestion-usuarios/gestion-usuarios.component';
import { AmigosComponent } from './hub-principal/amigos/amigos.component';
import { FeedComponent } from './hub-principal/feed/feed.component';
import { InicioComponent } from './hub-principal/inicio/inicio.component';
import { MusicComponent } from './hub-principal/music/music.component';
import { PlayListComponent } from './hub-principal/play-list/play-list.component';

const routes: Routes = [
  {path:'', component:InicioComponent, 
    children: [
      {path:'inicio', component : FeedComponent, 
        children: [
          {path:'recomendados', component: PlayListComponent},
          {path:'amigos', component: PlayListComponent},
        ]
      },
      {path:'playList', component : PlayListComponent},
      {path:'amigos', component : AmigosComponent},
      {path:'musica', component : MusicComponent}
    ]
  },
  {path:'GestionUsuarios',component:GestionUsuariosComponent},
  {path:'GestionPosts',component:GestionPostsComponent},
  {path:'CambioPassword',component:CambioPwdComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
