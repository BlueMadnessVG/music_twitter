import { Component  } from '@angular/core';
import { TUsuario } from './modelos/TUsuario.model';

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
  loggedin() {;
    this.loggedUser = localStorage.getItem('data')!;
    this.datosUser= JSON.parse(localStorage.getItem('data')!);
    return this.loggedUser;

  }

  onLogOut(){
    localStorage.removeItem('data');
    localStorage.removeItem('token');
    window.location.reload();
  }
}
