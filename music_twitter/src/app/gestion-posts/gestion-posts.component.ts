import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-gestion-posts',
  templateUrl: './gestion-posts.component.html',
  styleUrls: ['./gestion-posts.component.css']
})
export class GestionPostsComponent implements OnInit {
  flag:boolean=false;
  constructor() { }

  ngOnInit(): void {
  }

}
