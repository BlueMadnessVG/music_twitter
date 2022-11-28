import { Component  } from '@angular/core';
import { Router } from '@angular/router';
import { TUsuario } from './modelos/TUsuario.model';
import { UsrService } from './servicios/usuario.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'music_twitter';
  datosUser!:TUsuario;
  loggedUser !: string;
  imgurl:any;
  isadmin=false;
  loggedin() {

    if( localStorage.getItem('data') != null ){
      this.loggedUser = localStorage.getItem('data')!;
      this.datosUser= JSON.parse(localStorage.getItem('data')!);
      this.imgurl = this.datosUser.data.Foto_Perfil;
      if(this.datosUser.data.Rol==2){
        this.isadmin=true;
      }
    }


    return this.loggedUser;

  }

  constructor( private usuarioService: UsrService, private route: Router ) {

  }

  onLogOut(){
    localStorage.removeItem('data');
    localStorage.removeItem('token');
    this.route.navigate(['/principal']);
    window.location.reload();
  }

  showProfile(){

    this.usuarioService.sendData( JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario );
    this.route.navigate(['/usuario_info']);

  }

}
