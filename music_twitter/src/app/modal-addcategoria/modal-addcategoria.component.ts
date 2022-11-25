import { Component, OnInit } from '@angular/core';
import { Form, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { AdminService } from '../servicios/admin.service';
@Component({
  selector: 'app-modal-addcategoria',
  templateUrl: './modal-addcategoria.component.html',
  styleUrls: ['./modal-addcategoria.component.css']
})
export class ModalAddcategoriaComponent implements OnInit {
  frmaddcat!:FormGroup
  constructor(private fb:FormBuilder,private Admservice:AdminService) { }

  agregarcat(){
    alert(this.frmaddcat.controls['nombre'].value);
  }

  ngOnInit(): void {
    this.initform();
  }

  initform(){
    this.frmaddcat=this.fb.group({
      nombre:['',Validators,require],
  });
  }

}
