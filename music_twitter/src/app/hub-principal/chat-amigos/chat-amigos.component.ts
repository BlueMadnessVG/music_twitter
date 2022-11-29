import { Component, OnInit, EventEmitter, OnDestroy } from '@angular/core';
import { UsrService } from 'src/app/servicios/usuario.service';
import { FormBuilder,FormGroup,Validators } from '@angular/forms';
import { TUsuario } from 'src/app/modelos/TUsuario.model';
import { Subscription } from 'rxjs';
import { EnviarMensajeModel } from 'src/app/modelos/EnviarMensaje.model';
import { amigos } from 'src/app/modelos/Amigos.model';
import { ObtenerChatModel } from 'src/app/modelos/ObtenerChat.model';
import { ObtenerAmigosModel } from 'src/app/modelos/ObtenerAmigos.model';
import { Mensaje } from 'src/app/modelos/mensaje.model';

@Component({
  selector: 'chat-amigos',
  templateUrl: './chat-amigos.component.html',
  styleUrls: ['./chat-amigos.component.css']
})
export class ChatAmigosComponent implements OnInit, OnDestroy {

  chatSelect !: number;
  datasource! :TUsuario;
  id_usr! : number;

  frmMensaje!: FormGroup;
  subcription !: Subscription;
  mensajes!: Mensaje[];
  amigos!: amigos[];

  constructor( private fb : FormBuilder, private usuarioService : UsrService ) { }

  ngOnInit(): void {

    this.id_usr = JSON.parse( localStorage.getItem('data') || '{}' ).data.ID_Usuario;
    this.createForm();
    this.obtenerAmigos();

    this.subcription = this.usuarioService.refresh.subscribe( () => {
        this.obtenerChat();
    } )

  }

  ngOnDestroy(): void {

    if( this.subcription ){
      this.subcription.unsubscribe();
    }
    console.log("observable cerrado");
  }

  createForm() {

    this.frmMensaje = this.fb.group ( {
      Mensaje: [ '', Validators.required ],
    } );

  }


  //FUNCIONES PARA OBTENER AMIGOS DEL USUARIO

  submit_amigos( id_amigo: number ){

    this.chatSelect = id_amigo;
    this.obtenerChat();

  }

  obtenerAmigos() {

    this.usuarioService.obtenerAmigos(
      new ObtenerAmigosModel(
        this.id_usr
      )
    ).subscribe(
      ( data: any ) => {
        this.amigos = data.data;
        console.log(this.amigos);
      }
    )

  }

  // FUNCIONES PARA EL CHAT DE USUARIOS

  submit_chat(){

    if( this.frmMensaje.valid ) {
      this.EnviarMensaje();
      this.frmMensaje.controls['Mensaje'].reset();
    }

  }

  obtenerChat( ) {

    this.usuarioService.obtenerChat(
      new ObtenerChatModel( 
        this.id_usr,
        this.chatSelect
       )
    ).subscribe(
      (data: any) => {
        this.mensajes = data.data;
      }
    );

  }
  EnviarMensaje() {

    this.usuarioService.enviarMensaje(
      new EnviarMensajeModel(
        this.id_usr,
        this.chatSelect,
        this.frmMensaje.controls['Mensaje'].value
      )
    ).subscribe(
      (x) => {
      }
    );

  }

}
