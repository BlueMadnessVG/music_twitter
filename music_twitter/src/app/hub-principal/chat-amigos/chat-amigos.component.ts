import { Component, OnInit, EventEmitter, Output } from '@angular/core';
import { UsrService } from 'src/app/servicios/usuario.service';
import { FormBuilder,FormGroup,Validators } from '@angular/forms';
import { TUsuario } from 'src/app/modelos/TUsuario.model';
import { Subscription } from 'rxjs';
import { EnviarMensajeModel } from 'src/app/modelos/EnviarMensaje.model';
import { ObtenerChatModel } from 'src/app/modelos/ObtenerChat.model';
import { Mensaje } from 'src/app/modelos/mensaje.model';
import Swal from 'sweetalert2';

@Component({
  selector: 'chat-amigos',
  templateUrl: './chat-amigos.component.html',
  styleUrls: ['./chat-amigos.component.css']
})
export class ChatAmigosComponent implements OnInit {

  chatSelect !: string;
  datasource! :TUsuario;
  id_usr! : number;

  frmMensaje!: FormGroup;
  subcription !: Subscription;
  mensajes!: Mensaje[];

  constructor( private fb : FormBuilder, private usuarioService : UsrService ) { }

  ngOnInit(): void {

    this.id_usr = JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario;
    this.createForm();
    this.obtenerChat();

    this.subcription = this.usuarioService.refresh.subscribe( () => {
        this.obtenerChat();
    } )

  }

  createForm() {

    this.frmMensaje = this.fb.group ( {
      Mensaje: [ '', Validators.required ],
    } );

  }

  submit(){

    if( this.frmMensaje.valid ) {
      this.EnviarMensaje();
      this.frmMensaje.controls['Mensaje'].reset();
    }

  }

  obtenerChat() {

    this.usuarioService.obtenerChat(
      new ObtenerChatModel( 
        this.id_usr
       )
    ).subscribe(
      (data: any) => {
        this.mensajes = data.data;
        console.log( "jalo we", this.mensajes );
      }
    );

  }

  EnviarMensaje() {

    this.usuarioService.enviarMensaje(
      new EnviarMensajeModel(
        this.id_usr,
        1,
        this.frmMensaje.controls['Mensaje'].value
      )
    ).subscribe(
      (x) => {
        console.log("jalo we");
      }
    );

  }

  chatSeleccionado() {

    this.chatSelect = localStorage.getItem("chat")!;
    return this.chatSelect;

  }

}
