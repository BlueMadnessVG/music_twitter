import { Musica } from "./Musica.model";

export interface TEliminarPlaylist{

    message:string,
    status:number,
    data: Musica[];

}
