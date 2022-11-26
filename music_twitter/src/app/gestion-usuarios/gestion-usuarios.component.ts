import { Component, OnInit } from '@angular/core';
import { MatPaginator,MatPaginatorIntl } from '@angular/material/paginator';
import { MatSort} from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Usuario } from '../modelos/usuario.model';
import { AdminService } from '../servicios/admin.service';
import { ViewChild } from '@angular/core';
import { Subscription } from 'rxjs';
import Swal from 'sweetalert2';
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
     'ID_Rol',
     'Estatus',
     'Acciones'

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


  ChStatus(data:any){
    if(this.userdata.data.ID_Usuario!=data.ID_Usuario){
      if(data.Estatus=='I'){
        this.altastatus(data.ID_Usuario,data.Correo);
      }else{
        this.bajastatus(data.ID_Usuario,data.Correo);
      }
    }
  }

bajastatus(data:number,correo:string){
  Swal.fire({
    title: 'Alerta',
    html: '¿Está seguro de realizar la operación?',
    input:'text',
    showDenyButton: true,
    icon: 'info',
    customClass: {
      container: 'my-swal',
    },
    confirmButtonText: 'Si',
    denyButtonText: 'No',
  }).then((result) => {
    if (result.isConfirmed) {
      this.AdminService.darbajausr({
        ID_USUARIO: data,
      }).subscribe(
        (x) => {
          Swal.fire('Enhorabuena', 'Estatus de usuario cambiado correctamente', 'success');
          this.obtenerusers();
          this.obtenerusers();
          this.AdminService.sendcorreoban({
            correo:correo,
            motivo:result.value,
          }).subscribe((x)=>{


        })
        },
        (error) => console.log(error)
      );
    }
  });

}

altastatus(data:number,correo:string){
  Swal.fire({
    title: 'Alerta',
    html: '¿Está seguro de realizar la operación?',

    showDenyButton: true,
    icon: 'info',
    customClass: {
      container: 'my-swal',
    },
    confirmButtonText: 'Si',
    denyButtonText: 'No',
  }).then((result) => {
    if (result.isConfirmed) {
      this.AdminService.daraltausr({
        ID_USUARIO: data,
      }).subscribe(
        (x) => {
          Swal.fire('Enhorabuena', 'Estatus de usuario cambiado correctamente', 'success');
          this.obtenerusers();
          this.AdminService.sendcorreodesban({
            correo:correo,
          }).subscribe((x)=>{


        })
        },
        (error) => console.log(error)
      );
    }
  });
}


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
