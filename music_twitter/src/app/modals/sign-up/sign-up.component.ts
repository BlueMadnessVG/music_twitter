import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule } from '@angular/forms';
import { Validators } from '@angular/forms';
import { UsrService } from 'src/app/servicios/usuario.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {
  frmsign!:FormGroup;
  hidepass=true;
  hidepass2=true;
  constructor(private fb:FormBuilder,private usrService:UsrService) { }

  ngOnInit(): void {
    this.initform()
  }
initform(){

  this.frmsign = this.fb.group({
    correo: ['', [Validators.required, Validators.email]],
    pass: ['', Validators.required],
    pass2: ['', Validators.required],
    usuario: ['', Validators.required],
    descripcion: ['', Validators.required],
  });


}
  submit(){
    this.validacionpwd();
  }

  validacionpwd(){
    this.frmsign.controls['pass'].value == this.frmsign.controls['pass2'].value ? this.validfinal(): Swal.fire({
      title: 'Error de registro',
      html: 'Las contraseñas no coinciden, por favor, inténtelo de nuevo',
      icon: 'error',
      customClass: {
        container: 'my-swal',
      },
    });
  }

  validfinal(){

    if(!this.frmsign.controls['correo'].valid){
      Swal.fire({
        title: 'Error de registro',
        html: 'Inserte una dirección de correo válida.',
        icon: 'error',
        customClass: {
          container: 'my-swal',
        },
      });
      return;
    }
    if(this.frmsign.valid){
      this.usrService.registrarse({
        correo:this.frmsign.controls['correo'].value,
        contraseña:this.frmsign.controls['pass'].value,
        nombre_usuario:this.frmsign.controls['usuario'].value,
        descripcion:this.frmsign.controls['descripcion'].value,
      }).subscribe((x)=>
      Swal.fire('Enhorabuena', 'Has sido registrado correctamente, ¡ahora inicia sesión!', 'success')
      )
    }else{
      Swal.fire({
        title: 'Error de registro',
        html: 'Por favor, llene todos los campos correctamente e inténtelo de nuevo.',
        icon: 'error',
        customClass: {
          container: 'my-swal',
        },
      });
      return;
    }
  }



}
