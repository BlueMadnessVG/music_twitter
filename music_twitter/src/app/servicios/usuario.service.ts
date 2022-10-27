import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Observable, Subject, tap } from 'rxjs';

/* Modelos */
import { TUsuario } from "../modelos/TUsuario.model";

@Injectable( {

    providedIn: 'root',

})

export class UsrService {

    urlApi: string = 'http://localhost/api/';
    private _refresh$ = new Subject <void> ();
    get refresh() {
        return this._refresh$;
    }

    constructor( private client: HttpClient ) {}

    AmigosUsr(): Observable <TUsuario> {
        
        return this.client.post<TUsuario>(this.urlApi + '?u=MostrarUsuarios', null).pipe(
            tap(()=> {
                this.refresh.next();
            })
        );

    }

}