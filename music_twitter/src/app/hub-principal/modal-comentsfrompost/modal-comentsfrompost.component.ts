import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { comentarios } from 'src/app/modelos/comentarios.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'app-modal-comentsfrompost',
  templateUrl: './modal-comentsfrompost.component.html',
  styleUrls: ['./modal-comentsfrompost.component.css']
})
export class ModalComentsfrompostComponent implements OnInit {
frmcoment!:FormGroup;
comentarios!:comentarios[];
ArrayDatos!:any;
idpost!:any
subscription!: Subscription;
  constructor(private fb:FormBuilder,private usrService:UsrService) { }

  ngOnInit(): void {
    this.ArrayDatos=JSON.parse(localStorage.getItem("data")!);
    this.usrService.ObtencionComentarios.subscribe( (data: any) => {
    this.idpost=data.id_post;
    this.getcomentarios();
    });

    this.createForm();


  }


  createForm() {
    //Inicializamos frmlogin con validators
    this.frmcoment = this.fb.group({

      comentario: ['', Validators.required],
    });
  }


  getcomentarios(){
    this.usrService.getComentarios({
      id_post:this.idpost
    }).subscribe((x)=>{
    this.comentarios=x.data;
  });
  }


  ngOnDestroy() {

    if( this.subscription ){
      this.subscription.unsubscribe();
    }

  }
valid(){
  this.frmcoment.valid?this.comentar(): Swal.fire('Error', 'Por favor ingrese un comentario e inténtelo de nuevo', 'error');
}
  comentar(){


    this.usrService.comentarpost({
      id_post:this.idpost,
      id_usuario:this.ArrayDatos.data.ID_Usuario,
      comentario:this.frmcoment.controls['comentario'].value
    }).subscribe((x)=>
    {
      this.frmcoment.controls['comentario'].setValue('');
      Swal.fire('Enhorabuena', 'Comentario agregado correctamente', 'success');
      this.getcomentarios()
    })
  }







}
