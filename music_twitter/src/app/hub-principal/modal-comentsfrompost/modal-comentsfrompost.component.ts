import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule, Validators } from '@angular/forms';
import { comentarios } from 'src/app/modelos/comentarios.model';
import { UsrService } from 'src/app/servicios/usuario.service';
@Component({
  selector: 'app-modal-comentsfrompost',
  templateUrl: './modal-comentsfrompost.component.html',
  styleUrls: ['./modal-comentsfrompost.component.css']
})
export class ModalComentsfrompostComponent implements OnInit {
frmcoment!:FormGroup;
comentarios!:comentarios[];
ArrayDatos!:any;
  constructor(private fb:FormBuilder,private usrService:UsrService) { }

  ngOnInit(): void {
    this.ArrayDatos=JSON.parse(localStorage.getItem("data")!);
    this.createForm();
    this.getcomentarios();
  }


  createForm() {
    //Inicializamos frmlogin con validators
    this.frmcoment = this.fb.group({

      comentario: ['', Validators.required],
    });
  }


  getcomentarios(){
    this.usrService.getComentarios({
      id_post:22
    }).subscribe((x)=>

    this.comentarios=x.data

    )
  }







}
