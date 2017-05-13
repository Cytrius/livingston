import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import {Location} from '@angular/common';
import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './rates-form.template.html',
  styleUrls: ['./rates-form.styles.scss'],
  providers: [AppService]
})
export class RatesFormView  {

    private rate:any = {};

    private isLoading:boolean = true;
    private loading_action:string = 'Loading';

    constructor(
      private element:ElementRef,
      private router:Router,
      private route:ActivatedRoute,
      private appService:AppService,
      private location: Location
    ) {
    }

    private save() {
      this.isLoading = true;
      this.appService.saveRate(this.rate).then(res => {
        this.appService.getRate(+this.route.snapshot.params['rate_id']).then(rate => {
          this.rate = rate;
          this.isLoading = false;
          this.renderDropdowns();
        });
      });
    }

    private delete() {
      this.isLoading = true;
      this.appService.deleteRate(this.rate).then(res => {
         this.location.back();
      });
    }

    private renderDropdowns() {
      setTimeout(() => {
        $(this.element.nativeElement).find('.ui.dropdown').dropdown();
      });
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      this.appService.getRate(+this.route.snapshot.params['rate_id']).then(rate => {
        this.rate = rate;
        this.isLoading = false;
        this.renderDropdowns();
      });
    }

}