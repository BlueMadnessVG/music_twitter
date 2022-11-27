import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule } from '@angular/forms';
@Component({
  selector: 'sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {
  frmsign!:FormGroup;
  hidepass=true;
  hidepass2=true;
  constructor(private fb:FormBuilder) { }

  ngOnInit(): void {
  }

  submit(){

  }



}
