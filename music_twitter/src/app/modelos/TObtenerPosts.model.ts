import { post } from "./Post.model";

export interface TObtenerPosts {

    message: string;
    status: number;
    data: post[];

}
