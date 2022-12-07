import { Component, OnInit,ViewChild } from '@angular/core';
import { Subscription } from 'rxjs';
import { MatTable } from '@angular/material/table';
import { MatPaginator,MatPaginatorIntl } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { postgestion } from '../modelos/postgestion.model';
import { AdminService } from '../servicios/admin.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'app-gestion-posts',
  templateUrl: './gestion-posts.component.html',
  styleUrls: ['./gestion-posts.component.css']
})
export class GestionPostsComponent implements OnInit {
  userdata:any;
  flag: boolean = false;
  subscription!: Subscription;
  displayedColumns: string[] = [
    'ID_Post',
    'urlImg',
    'username',
     'Titulo',
     'Categoria',
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
  constructor(private admservice:AdminService) { }

  ngOnInit(): void {
    this.GetPostAdmin();
  }


  ChStatus(data:any){
    // alert(data.ID_Usuario)
    // alert(data.ID_Post)
    // alert(data.nombrerola);
    // alert(data.Correo)
    // return;
    Swal.fire({
      title: 'Alerta',
      html: '¿Está seguro de realizar la operación? Por favor ingrese el motivo de baneo',
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
        this.admservice.DelPost({
          id_usuario: data.ID_Usuario,
          id_post:data.ID_Post,
          nombre_post:data.nombrerola,
          correo:data.Correo,
          motivo:result.value
        }).subscribe(
          (x) => {
            Swal.fire('Enhorabuena', 'Post eliminado coorrectamente', 'success');
            this.GetPostAdmin();
           } );
      }
    });
  }
  dataSource= new MatTableDataSource<postgestion>();

  GetPostAdmin(){
    this.admservice.GetPostAdmin().subscribe({

      error: (error) => {
        alert(error.error);
      },
      complete: () => {},
      next: (response) => {
        this.dataSource.data = response.data;
        this.flag = true;
      },


    })
  }


}
