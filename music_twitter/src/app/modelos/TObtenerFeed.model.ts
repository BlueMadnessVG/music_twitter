import { ObtenerFeedModel } from "./ObtenerFeed.model";


export interface TObtenerFeed {

    message: string;
    status: number;
    data: ObtenerFeedModel[];

}
