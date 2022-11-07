import { ComponentFixture, TestBed } from '@angular/core/testing';

import { GestionPostsComponent } from './gestion-posts.component';

describe('GestionPostsComponent', () => {
  let component: GestionPostsComponent;
  let fixture: ComponentFixture<GestionPostsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ GestionPostsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(GestionPostsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
