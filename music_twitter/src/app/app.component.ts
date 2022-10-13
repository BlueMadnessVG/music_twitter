import { Component  } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'music_twitter';

  loggedUser !: string;
  loggedin() {;
    this.loggedUser = localStorage.getItem('UsrName')!;
    return this.loggedUser;
  }

  onLogOut(){
    localStorage.removeItem('UsrName');
  }
}
