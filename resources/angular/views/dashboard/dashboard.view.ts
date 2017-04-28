import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './dashboard.template.html',
  styleUrls: ['./dashboard.styles.scss'],
  providers: [AppService]
})
export class DashboardView  {

    private profiles:any[];

    private isLoading:boolean = true;
    private loading_action:string = 'Loading';

    constructor(
      private element:ElementRef,
      private router:Router,
      private route:ActivatedRoute,
      private appService:AppService
    ) {
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      this.isLoading = false;
    }

}