import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { UsrService } from 'src/app/servicios/usuario.service';

@Component({
  selector: 'inicio',
  templateUrl: './inicio.component.html',
  styleUrls: ['./inicio.component.css']
})
export class InicioComponent implements OnInit {

  constructor( private usuarioService: UsrService ) { }

  ngOnInit(): void {
  }

}
