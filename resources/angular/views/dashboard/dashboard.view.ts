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

    private quotes:any[];

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

    private prev() {
      if (this.filterSelect.page > 0)
      this.filterSelect.page = this.filterSelect.page-1;
      this.loadFilteredData();
    }
    private next() {
      this.filterSelect.page = this.filterSelect.page+1;
      this.loadFilteredData();
    }
    private first() {
      this.filterSelect.page = 0;
      this.loadFilteredData();
    }

    private clear() {
      this.filterSelect = {
        origin: null,
        destination: null,
        type: null,
        account: null,
      page:0
      };
      $(this.element.nativeElement).find('.ui.dropdown').dropdown('clear');
      this.loadFilteredData();
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

    private loadFilteredData() {
      setTimeout(() => {
        this.isLoading = true;
        console.log(this.filterSelect);
        this.appService.getFilteredQuotes(this.filterSelect).then(quotes => {
          this.quotes = quotes;
          this.isLoading = false;
          this.renderDropdowns();
          this.renderDatepicker();
        });
      });
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      this.appService.getAllQuotesFilters().then(filters => {
        this.filterOptions.origins = filters.origins;
        this.filterOptions.destinations = filters.destinations;
        this.filterOptions.accounts = filters.accounts;

          this.appService.getAllQuotes().then(quotes => {
            this.quotes = quotes;
            this.isLoading = false;
            this.renderDropdowns();
            this.renderDatepicker();
          });
       });
    }
}