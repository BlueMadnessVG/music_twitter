import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'chat-amigos',
  templateUrl: './chat-amigos.component.html',
  styleUrls: ['./chat-amigos.component.css']
})
export class ChatAmigosComponent implements OnInit {

  chatSelect !: string;

  constructor() { }

  ngOnInit(): void {
  }

  chatSeleccionado() {

    this.chatSelect = localStorage.getItem("chat")!;
    return this.chatSelect;

  }

}
