import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, Subject, tap } from 'rxjs';
import { usersdata } from '../modelos/usersdata.model';
import { Usuario } from '../modelos/usuario.model';
@Injectable({
  providedIn: 'root',
})
export class AdminService {
  urlApi: string = 'http://localhost/api/';
  private _refresh$ = new Subject<void>();
  get refresh() {
    return this._refresh$;
  }
  constructor(private cliente: HttpClient) {}



getusers():Observable <usersdata>{
  return this.cliente
      .post<usersdata>(this.urlApi + '?u=GetUsuarios', null, {
      })
      .pipe(
        tap(() => {
          this.refresh.next();
        })
      );
}

darbajausr(data:any){
  return this.cliente.post(
    this.urlApi+'?u=DarBajaUsuario',JSON.stringify(data)
  ).pipe(
    tap(()=>{
      this.refresh.next();
    })
  );
}

daraltausr(data:any){
  return this.cliente.post(
    this.urlApi+'?u=DarAltaUsuario',JSON.stringify(data)
  ).pipe(
    tap(()=>{
      this.refresh.next();
    })
  );
}



}
