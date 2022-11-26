import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { JwtHelperService } from '@auth0/angular-jwt';
import { Observable, Subject, tap } from 'rxjs';
import { TCategorias } from '../modelos/TCategorias.model';
import { Teditperfil } from '../modelos/Teditperfil.model';
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

editarperfil(data:any):Observable <Teditperfil>{
return this.cliente.post<Teditperfil>(
  this.urlApi+'?u=ModificarUsuario',
  JSON.stringify(data)
)
}
saveToken(data: any) {
  localStorage.setItem('token', data);
  const helper = new JwtHelperService();
  localStorage.setItem('data', JSON.stringify(helper.decodeToken(data)));
}


modestatuscat(data:any){
  return this.cliente.post(this.urlApi+'?u=ModificarCategoria',JSON.stringify(data));
}

agregarcat(data:any){
  return this.cliente.post(this.urlApi+'?u=RegistrarCategoria',JSON.stringify(data));

}

sendcorreoban(data:any){
  return this.cliente.post(this.urlApi+'?u=EnviarCorreoBan',JSON.stringify(data));
}

sendcorreodesban(data:any){
  return this.cliente.post(this.urlApi+'?u=EnviarCorreodesBan',JSON.stringify(data));
}


}
