import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HubPrincipalModule } from './hub-principal/hub-principal.module';
import { ModalsModule } from './modals/modals.module';
import { FormsModule,ReactiveFormsModule } from '@angular/forms';
import { EditarPerfilComponent } from './editar-perfil/editar-perfil.component';
import { GestionUsuariosComponent } from './gestion-usuarios/gestion-usuarios.component';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatTableModule } from '@angular/material/table';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatFormFieldModule } from "@angular/material/form-field";
import { MatTableDataSource } from '@angular/material/table';
import { GestionPostsComponent } from './gestion-posts/gestion-posts.component';
import { CambioPwdComponent } from './cambio-pwd/cambio-pwd.component';
@NgModule({
  declarations: [
    AppComponent,
    EditarPerfilComponent,
    GestionUsuariosComponent,
    GestionPostsComponent,
    CambioPwdComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HubPrincipalModule,
    ModalsModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    NoopAnimationsModule,
    MatPaginatorModule,
    MatTableModule,
    MatIconModule,
    MatFormFieldModule,
    MatInputModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
