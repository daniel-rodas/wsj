/**
 * Created by Rodas on 7/4/2016.
 */
import { Component } from '@angular/core';

// import {NgClass} from '@angular/common';

@Component({
    selector: 'rn-navigation',
    templateUrl: '/angular/template/navigation',
    styles: [`
    .active {
      text-decoration: underline;
    }
  `]

})

export class NavigationComponent {
    public pathArray;

    public firstLevelUriSegment;

    public isActive = false;

    constructor()
    {
        this.pathArray = window.location.pathname.split( '/' );
        console.log(this.pathArray);
    }

    captureUriSegment( pathName: string ):boolean
    {
        this.firstLevelUriSegment = this.pathArray[1];
        return ( pathName === this.firstLevelUriSegment ? true : false );
    }

}