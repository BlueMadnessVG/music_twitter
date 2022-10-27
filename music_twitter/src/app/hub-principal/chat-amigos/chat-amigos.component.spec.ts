import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ChatAmigosComponent } from './chat-amigos.component';

describe('ChatAmigosComponent', () => {
  let component: ChatAmigosComponent;
  let fixture: ComponentFixture<ChatAmigosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ChatAmigosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ChatAmigosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
