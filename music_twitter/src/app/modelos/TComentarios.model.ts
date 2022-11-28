import {comentarios} from './comentarios.model';


export interface TComentarios{
  message:string,
  status:number,
  data:comentarios[]
}
