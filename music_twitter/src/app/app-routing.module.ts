import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CambioPwdComponent } from './cambio-pwd/cambio-pwd.component';
import { GestionPostsComponent } from './gestion-posts/gestion-posts.component';
import { GestionUsuariosComponent } from './gestion-usuarios/gestion-usuarios.component';
import { InicioComponent } from './hub-principal/inicio/inicio.component';
const routes: Routes = [
  {path:'', component:InicioComponent},
  {path:'GestionUsuarios',component:GestionUsuariosComponent},
  {path:'GestionPosts',component:GestionPostsComponent},
  {path:'CambioPassword',component:CambioPwdComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
