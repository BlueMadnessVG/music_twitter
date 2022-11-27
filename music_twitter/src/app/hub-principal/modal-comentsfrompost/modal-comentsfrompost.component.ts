import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule, Validators } from '@angular/forms';
@Component({
  selector: 'app-modal-comentsfrompost',
  templateUrl: './modal-comentsfrompost.component.html',
  styleUrls: ['./modal-comentsfrompost.component.css']
})
export class ModalComentsfrompostComponent implements OnInit {
frmcoment!:FormGroup;
  constructor(private fb:FormBuilder) { }

  ngOnInit(): void {
  }


  createForm() {
    //Inicializamos frmlogin con validators
    this.frmcoment = this.fb.group({

      comentario: ['', Validators.required],
    });
  }
}
