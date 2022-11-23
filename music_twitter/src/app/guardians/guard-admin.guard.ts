import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { TUsuario } from '../modelos/TUsuario.model';
import { UsrService } from '../servicios/usuario.service';

@Injectable({
  providedIn: 'root'
})
export class GuardAdminGuard implements CanActivate {
  constructor(private usrService:UsrService,private router:Router){}
  arrayDatos!:TUsuario;
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
      if(!this.usrService.islogin()){
        return false;
      }else{
        this.arrayDatos=JSON.parse(localStorage.getItem('data')!);
        if(this.arrayDatos.data.Rol!=2){
          this.router.navigate(['inicio']);
          return false;
        }
      }
      return true;
  }


}
