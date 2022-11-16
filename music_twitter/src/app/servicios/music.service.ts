import { EventEmitter, Injectable, Output } from "@angular/core";
import { Observable, BehaviorSubject, Subject, observable } from "rxjs";
import { takeUntil } from "rxjs/operators";
import * as moment from "moment";
import { MusicState } from "../modelos/Music.model";

@Injectable({

    providedIn: "root"

})

export class MusicService {

    private stop$ = new Subject();
    private musicObj = new Audio();

    musicEvents = [
        "ended",
        "error",
        "play",
        "playing",
        "pause",
        "timeupdate",
        "canplay",
        "loadedmetadata",
        "loadstart"
    ];

    private state: MusicState = {

        playing: false,
        readableCurrentTime: '',
        readableDuration: '',
        duration: undefined,
        currentTime: undefined,
        canplay: false,
        error: false,

    };

    private stateChange: BehaviorSubject < MusicState > = new BehaviorSubject(
        this.state
    );

    private updateStateEvent( event: Event ): void {

        switch ( event.type ) {

            case "canplay":
                this.state.duration = this.musicObj.duration;
                this.state.readableDuration = this.formatTime( this.state.duration );
                this.state.canplay = true;
                break;
            case "playing":
                this.state.playing = true;
                break;
            case "pause":
                this.state.playing = false;
                break;
            case "timeupdate":
                this.state.currentTime = this.musicObj.currentTime;
                this.state.readableCurrentTime = this.formatTime( this.state.currentTime );
                break;
            case "error":
                this.resetState();
                this.state.error = true;
                break;
        }

        this.stateChange.next( this.state );

    };

    private resetState() {
        this.state = {
            playing: false,
            readableCurrentTime: '',
            readableDuration: '',
            duration: undefined,
            currentTime: undefined,
            canplay: false,
            error: false
        };
    }

    getState(): Observable < MusicState > {

        return this.stateChange.asObservable();
    
    }

    private streamObservable(url: any) {
        return new Observable( observable => {
            this.musicObj.src = url;
            this.musicObj.load();
            this.musicObj.play();

            const handler = ( event: Event ) => {
                this.updateStateEvent( event );
                observable.next(event);
            };

            this.addEvent( this.musicObj, this.musicEvents, handler );
            return () => {

                this.musicObj.pause();
                this.musicObj.currentTime = 0;
                this.removeEvents( this.musicObj, this.musicEvents, handler );
                this.resetState();
            }

        } );
    }

    private addEvent( obj: any, event: any, handler: any ) {
        event.forEach( (event: any) => {

            obj.addEventListener(event, handler);

        } )
    }

    private removeEvents( obj: any, events: any, handler: any ) {
        events.forEach((event: any) => {

          obj.removeEventListener(event, handler);

        });
    }

    playStream( url: any ) {

        return this.streamObservable(url).pipe(takeUntil(this.stop$));

    }

    play() {
        this.musicObj.play();
    }
    
    pause() {
        this.musicObj.pause();
    }
    
    stop() {
        this.stop$.next(true);
    }
    
    seekTo( seconds: any ) {
        this.musicObj.currentTime = seconds;
    }
    
    formatTime(time: number, format: string = "mm:ss") {
        const momentTime = time * 1000;
        return moment.utc(momentTime).format(format);
    }

    /* Reproducir playList */
    @Output() MusicTrigger: EventEmitter<any> = new EventEmitter();
}