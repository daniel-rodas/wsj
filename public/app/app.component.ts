import { Component } from '@angular/core';

export class Hero {
    id: number;
    name: string;
}

@Component({
    selector: 'my-app',
    // templateUrl: '/angular/template/application'
    template: ''
})
export class AppComponent {
    title = 'Read Wall Street Journal Articles.';
    hero: Hero = {
        id: 1,
        name: 'Churchill'
    };
}

