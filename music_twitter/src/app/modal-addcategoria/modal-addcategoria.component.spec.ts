import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalAddcategoriaComponent } from './modal-addcategoria.component';

describe('ModalAddcategoriaComponent', () => {
  let component: ModalAddcategoriaComponent;
  let fixture: ComponentFixture<ModalAddcategoriaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalAddcategoriaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalAddcategoriaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
