import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PagPrincComponent } from './pag-princ.component';

describe('PagPrincComponent', () => {
  let component: PagPrincComponent;
  let fixture: ComponentFixture<PagPrincComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PagPrincComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PagPrincComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
