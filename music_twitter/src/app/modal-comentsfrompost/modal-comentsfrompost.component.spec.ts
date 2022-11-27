import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalComentsfrompostComponent } from './modal-comentsfrompost.component';

describe('ModalComentsfrompostComponent', () => {
  let component: ModalComentsfrompostComponent;
  let fixture: ComponentFixture<ModalComentsfrompostComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalComentsfrompostComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalComentsfrompostComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
