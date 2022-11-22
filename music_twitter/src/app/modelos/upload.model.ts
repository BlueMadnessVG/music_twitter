export class Upload {

    $key!: string;
    file: File;
    name!: string;
    utl!: string;
    progress!: number;
    createdAt: Date = new Date();

    constructor( file: File ){
        this.file = file
    }


}