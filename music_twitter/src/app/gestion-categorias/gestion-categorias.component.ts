import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator,MatPaginatorIntl } from '@angular/material/paginator';
import { MatTable } from '@angular/material/table';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { categorias } from '../modelos/categorias.model';
import { UsrService } from '../servicios/usuario.service';
import Swal from 'sweetalert2';
import { AdminService } from '../servicios/admin.service';
import { ModalAddcategoriaComponent } from '../modal-addcategoria/modal-addcategoria.component';
@Component({
  selector: 'app-gestion-categorias',
  templateUrl: './gestion-categorias.component.html',
  styleUrls: ['./gestion-categorias.component.css']
})
export class GestionCategoriasComponent implements OnInit {
  constructor(private usrService:UsrService,private AdminService:AdminService) { }

  flag=false;
  displayedColumns: string[] = [
    'id',
    'nombre',
    'estatus',
    'acciones'

  ];

  @ViewChild('modal') modal!: ModalAddcategoriaComponent;


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

  ngOnInit(): void {
    this.getcat();
  }

  getcat(){

      this.usrService.getcategorias().subscribe({
        error: (error) => {
          alert(error.error);
        },
        complete: () => {},
        next: (response) => {
          response.data.shift();
          this.dataSource.data = response.data;
          this.flag = true;
        },
      });

  }


  ChStatus(data:any){
    //alert(data.ID_Categoria);

      if(data.Estatus=='I'){

        this.altastatus(data.ID_Categoria);
      }else{

        this.bajastatus(data.ID_Categoria);
      }

  }

  altastatus(data:number){
    this.swalconfirmar(1,data);
  }

  bajastatus(data:number){
    this.swalconfirmar(0,data);
  }

  swalconfirmar(oper:number,idcat:number){
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
        if(oper==0){//se va a dar de baja
          this.AdminService.modestatuscat({
            id_categoria:idcat,
            estatus:'I'
          }).subscribe(
            (x) => {
              Swal.fire('Enhorabuena', 'Estatus de categoria cambiado correctamente', 'success');
              this.getcat();
            },
            (error) => console.log(error)
          );
        }else{//se da de alta otra vez
          this.AdminService.modestatuscat({
            id_categoria:idcat,
            estatus:'A'
          }).subscribe(
            (x) => {
              Swal.fire('Enhorabuena', 'Estatus de categoria cambiado correctamente', 'success');
              this.getcat();
            },
            (error) => console.log(error)
          );
        }

      }
    });
  }

  dataSource= new MatTableDataSource<categorias>();

}
