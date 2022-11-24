import { categorias } from "./categorias.model";


export interface TCategorias{
  message:string,
  status:number,
  data:categorias[]
}
