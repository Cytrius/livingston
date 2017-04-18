import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';

declare var $:any;
declare var window:any;

@Component({
    selector: 'app',
    template: `
        <header></header>
        <router-outlet (activate)="onActivate($event, outlet)" #outlet></router-outlet>
    `,
    styleUrls: [
        './styles/app.style.scss',
        './styles/layout.style.scss',
        './styles/element.style.scss'
    ]
})
export class AppComponent {

    /**
     * On App Initialize
     */
    ngOnInit() {

    }

    /**
     * Scroll to top of page when router changes
     */
    onActivate(e, outlet){
        outlet.scrollTop = 0;
    }

}