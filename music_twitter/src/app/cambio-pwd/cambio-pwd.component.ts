import { Component, OnInit } from '@angular/core';
import { FormGroup,Form,ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { TUsuario } from '../modelos/TUsuario.model';
import { Validators } from '@angular/forms';
import Swal from 'sweetalert2';
import { UsrService } from '../servicios/usuario.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-cambio-pwd',
  templateUrl: './cambio-pwd.component.html',
  styleUrls: ['./cambio-pwd.component.css']
})
export class CambioPwdComponent implements OnInit {
  frmDatos!: FormGroup;
  hide = true;
  hide2 = true;
  hide3 = true;
  constructor(private fb:FormBuilder,private usrService:UsrService, private route: Router) { }

  datosUsuario:TUsuario = JSON.parse(localStorage.getItem('data')!);

  ngOnInit(): void {
    this.crearform();
  }

  crearform(){
    this.frmDatos = this.fb.group({
      pwd1: ['', [Validators.minLength(8), Validators.required]],
      pwd2: ['', [Validators.minLength(8), Validators.required]],
      pwdold: ['', [Validators.required]],
    });
  }

  Limpiar(){
    this.frmDatos.reset();
  }

  submit(){
    if(this.frmDatos.valid){
      var pwd = this.frmDatos.controls['pwd1'].value;
      var pwd2 = this.frmDatos.controls['pwd2'].value;
      if(pwd==pwd2)
      this.cambiarpwd();
      else
      Swal.fire('Error', 'Confirme correctamente su contraseña e inténtelo de nuevo', 'error');
    }else{
      Swal.fire('Error', 'Verifique que los datos son correctos e inténtelo de nuevo', 'error');
    }
  }

  cambiarpwd(){
    this.usrService
      .cambiopwd({
        ID_USUARIO: this.datosUsuario.data.ID_Usuario,
        Pass: this.frmDatos.controls['pwd1'].value,
        Passold: this.frmDatos.controls['pwdold'].value,
      })
      .subscribe(
        (x) => {
          Swal.fire('Enhorabuena', x.data.toString(), 'success').then( () => {
            this.route.navigate( ["/inicio"] );
          }
          );
        },
        (error) => Swal.fire('Error', 'Algo salió mal, por favor intentelo de nuevo', 'error')
      );
  }

}
