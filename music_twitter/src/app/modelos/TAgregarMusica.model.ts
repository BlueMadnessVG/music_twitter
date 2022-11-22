import { AgregarMusica } from "./AgregarMusica.model";
import { Musica } from "./Musica.model";

export interface TAgregarMusica {

    message: string;
    status: number;
    musica: AgregarMusica;

}
