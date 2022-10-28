import { Component, OnInit } from '@angular/core';
import { Usuario } from 'src/app/modelos/usuario.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import { TUsuario } from 'src/app/modelos/TUsuario.model';
import { Subscription } from 'rxjs';

@Component({
  selector: 'chat-amigos',
  templateUrl: './chat-amigos.component.html',
  styleUrls: ['./chat-amigos.component.css']
})
export class ChatAmigosComponent implements OnInit {

  chatSelect !: string;
  subcription !: Subscription;
  datasource! :TUsuario;
  constructor(private usrser:UsrService) { }

  ngOnInit(): void {
    this.obtener();
  }
  
  obtener(){

    this.usrser.AmigosUsr().subscribe(x=>{
      
      this.datasource=x;
      console.log(this.datasource);
  })}

  chatSeleccionado() {

    this.chatSelect = localStorage.getItem("chat")!;
    return this.chatSelect;

  }

}
