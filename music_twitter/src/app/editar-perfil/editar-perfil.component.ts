import { Component, OnInit } from '@angular/core';
import { Form, FormBuilder, FormGroup,Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { Teditperfil } from '../modelos/Teditperfil.model';
import { AdminService } from '../servicios/admin.service';
import Swal from 'sweetalert2';
import { Router } from '@angular/router';
@Component({
  selector: 'app-editar-perfil',
  templateUrl: './editar-perfil.component.html',
  styleUrls: ['./editar-perfil.component.css']
})
export class EditarPerfilComponent implements OnInit {
  frmEditar!:FormGroup;
  editarperfil!:Teditperfil;
  imgurl:any;
  public rutafoto:any;
  public message!:string;
  reader = new FileReader();
  constructor(private fb:FormBuilder,private AdminService:AdminService,private route:Router) { }

  ngOnInit(): void {
    this.editarperfil=JSON.parse(localStorage.getItem("data")!);
    this.imgurl=this.editarperfil.data.Foto_Perfil;
    this.initform();
  }

  initform(){
    this.frmEditar=this.fb.group({
      username:[this.editarperfil.data.Nombre_Usuario,Validators.required],
      correo:[this.editarperfil.data.Correo,Validators.required],
      descripcion:[this.editarperfil.data.Descripcion,Validators.required],
      filePost:[''],

  });
  }

  preview(files:any){

    if (files.length === 0) return;
    //Si el archivo tiene longitud verificaremos su MIME  y en caso de que no sea imagen termimos el proceso
    var mimeType = files[0].type;
    if (mimeType.match(/image\/*/) == null) {
      this.message = 'Only images are supported.';
      return;
    }

    //Instanciamos el lector de archivos

    this.rutafoto = files;
    this.reader.readAsDataURL(files[0]);
    this.reader.onload = (_event) => {
      this.imgurl = this.reader.result;
    };
  }

  submit(){
    this.AdminService.editarperfil({
      id_usr:JSON.parse(localStorage.getItem("data")||'{}').data.ID_Usuario,
      nombre:this.frmEditar.controls['username'].value,
      correo:this.frmEditar.controls['correo'].value,
      descripcion:this.frmEditar.controls['descripcion'].value,
      foto_perfil:this.reader.result,

    }).subscribe((x)=>{
     // console.log(x);
      localStorage.removeItem('token');
      //alert(x.data);
      this.AdminService.saveToken(x.data);

      Swal.fire({
       title: 'Datos modificados',
       html: 'Se actualizó la información',
       icon: 'success',
       customClass: {
         container: 'my-swal',
       },
     })
     this.route.navigate(['/inicio']);
    })
  }





}
