import { Component, Input, Output, EventEmitter, ElementRef } from '@angular/core';
import { Router } from '@angular/router';

declare var $:any;
declare var window:any;

@Component({
  selector: 'header',
  templateUrl: './header.template.html',
  styleUrls: ['./header.styles.scss'],
})
export class HeaderComponent  {

    private query;

    constructor(
      private element:ElementRef,
      private router:Router
    ) {
    }

    private searchKeyPress(keyCode) {
      if (keyCode === 13)
        if (this.query.length)
          this.router.navigate(['/dashboard', 'search', this.query]);
        else
          this.router.navigate(['/dashboard']);
    }

   private downloadExtension() {
     $('.ui.modal').modal('show');
     window.location.replace('/sonas.crx.zip');
   }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      
    }

}