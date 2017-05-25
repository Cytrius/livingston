import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './quotes.template.html',
  styleUrls: ['./quotes.styles.scss'],
  providers: [AppService]
})
export class QuotesView  {

    private quote:any;
    private notifications:any[];

    private filterOptions:any = {
      origins: [],
      destinations: [],
      accounts: []
    };

    private filterSelect:any = {
      origin: null,
      destination: null,
      created_at: null,
      account: null,
      page:0
    };

    private isLoading:boolean = true;
    private loading_action:string = 'Loading';

    constructor(
      private element:ElementRef,
      private router:Router,
      private route:ActivatedRoute,
      private appService:AppService
    ) {
    }

    private renderDropdowns() {
      setTimeout(() => {
        $(this.element.nativeElement).find('.ui.dropdown').dropdown();
      });
    }
    private renderDatepicker() {
      setTimeout(() => {
        $(this.element.nativeElement).find('input[type="date"]').flatpickr({animate: false});
      });
    }

    private notify(quote_id) {
      this.isLoading = true;
      this.appService.notify(quote_id).then(res => {
        this.notifications = res
        this.isLoading = false;
      });
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {

      this.appService.getQuoteById(+this.route.snapshot.params['id']).then(quote => {
          this.quote = quote;
          this.isLoading = false;
          this.renderDropdowns();
          this.renderDatepicker();
      });
    }
}