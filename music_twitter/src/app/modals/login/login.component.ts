import { Component, EventEmitter, Output } from '@angular/core';
import { FormBuilder,FormGroup,Validators } from '@angular/forms';
import { LoginModel } from 'src/app/modelos/Login.model';
import { UsrService } from 'src/app/servicios/usuario.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  frmLogin!: FormGroup;
  vista:boolean=false;
  constructor(private fb: FormBuilder,private usuarioService:UsrService) {

  }

  ngOnInit(): void {
    this.createForm();
  }

  createForm() {
    //Inicializamos frmlogin con validators
    this.frmLogin = this.fb.group({
      Correo: ['', [Validators.required, Validators.email]],
      Pass: ['', Validators.required],
    });
  }
submit(){

  if(this.frmLogin.valid){
    this.iniciar_sesion();
  }


}

iniciar_sesion(){

    //Aqui se consumira el Servicio del Login
    this.usuarioService.login(
      new LoginModel(
        this.frmLogin.controls['Correo'].value,
        this.frmLogin.controls['Pass'].value
      )
    ).subscribe(
        (x) => {
         // const date = new Date();
          this.hideModal();
          this.usuarioService.saveToken(x.data);
          window.location.reload();
          console.log("jalo we");
        },
        (error) =>
          Swal.fire({
            title: 'Alerta',
            html: 'Error: ' + error.error.data,
            icon: 'error',
            customClass: {
              container: 'my-swal',
            },
          })
      );
  }


  hideModal(){

  }

}


