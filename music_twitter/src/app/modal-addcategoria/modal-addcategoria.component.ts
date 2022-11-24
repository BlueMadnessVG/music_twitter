import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-modal-addcategoria',
  templateUrl: './modal-addcategoria.component.html',
  styleUrls: ['./modal-addcategoria.component.css']
})
export class ModalAddcategoriaComponent implements OnInit {
  flag=false;
  constructor() { }

  showmodal(){
    this.flag=true;
  }


  ngOnInit(): void {
  }

}
