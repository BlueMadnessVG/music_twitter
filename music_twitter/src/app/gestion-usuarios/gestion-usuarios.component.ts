import { Component, OnInit } from '@angular/core';
import { MatPaginator,MatPaginatorIntl } from '@angular/material/paginator';
import { MatSort} from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Usuario } from '../modelos/usuario.model';
import { AdminService } from '../servicios/admin.service';
import { ViewChild } from '@angular/core';
import { Subscription } from 'rxjs';
@Component({
  selector: 'app-gestion-usuarios',
  templateUrl: './gestion-usuarios.component.html',
  styleUrls: ['./gestion-usuarios.component.css']
})
export class GestionUsuariosComponent implements OnInit {
  userdata:any;
  flag: boolean = false;
  subscription!: Subscription;
  displayedColumns: string[] = [
    'ID_Usuario',
    'urlImg',
    'username',
     'Correo',
     'Fecha_Nacimiento',
     'ID_Rol',
     'Estatus',
        
  ];


  @ViewChild(MatPaginator, { static: false })
  set paginator(value: MatPaginator) {
    if (this.dataSource) {
      this.dataSource.paginator = value;
    }
  }

  //Establece un Orden Utilizando Datos de la API
  @ViewChild(MatSort, { static: false })
  set sort(value: MatSort) {
    if (this.dataSource) {
      this.dataSource.sort = value;
    }
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;

    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  constructor(private Paginatorstr:MatPaginatorIntl,private AdminService:AdminService) {
    this.Paginatorstr.itemsPerPageLabel = 'Registros por Pagina';
    this.dataSource.paginator = this.paginator;
    this.userdata=JSON.parse(localStorage.getItem('data')!);

   }

  ngOnInit(): void {
    this.obtenerusers();
  }

  Editar(data:any){

  }

  CambiarPassword(data:any){}

  Eliminar(data:any){}


  obtenerusers(){
    this.AdminService.getusers().subscribe({
      error: (error) => {
        alert(error.error);
      },
      complete: () => {},
      next: (response) => {
        this.dataSource.data = response.data;
        console.log(response);
        this.flag = true;
      },
    });
  }
  dataSource= new MatTableDataSource<Usuario>();

}
