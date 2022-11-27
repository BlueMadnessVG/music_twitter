import { Component, EventEmitter, Output } from '@angular/core';
import { FormBuilder,FormGroup,Validators } from '@angular/forms';
import { Router } from '@angular/router';
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
  constructor(private fb: FormBuilder, private usuarioService:UsrService, private route: Router) {

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
         document.getElementById("btn-close")?.click();
        // alert(x.data)
          this.usuarioService.saveToken(x.data);
          this.route.navigate(['/inicio']);
        },
        (error) =>
          Swal.fire({
            title: 'Error de inicio de sesión',
            html: 'Error: ' + 'Datos introducidos inválidos, por favor, inténtelo de nuevo',
            icon: 'error',
            customClass: {
              container: 'my-swal',
            },
          })
      );
  }

}


