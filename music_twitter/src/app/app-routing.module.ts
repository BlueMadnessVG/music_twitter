import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { GestionUsuariosComponent } from './gestion-usuarios/gestion-usuarios.component';
import { InicioComponent } from './hub-principal/inicio/inicio.component';

const routes: Routes = [
  {path:'', component:InicioComponent},
  {path:'GestionUsuarios',component:GestionUsuariosComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
