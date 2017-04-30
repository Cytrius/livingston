import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './rates.template.html',
  styleUrls: ['./rates.styles.scss'],
  providers: [AppService]
})
export class RatesView  {

    private rates:any[];

    private filterOptions:any = {
      origins: [],
      destinations: [],
      types: [],
      accounts: []
    };

    private filterSelect:any = {
      origin: null,
      destination: null,
      type: null,
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
        page: 0
      };
      $(this.element.nativeElement).find('.ui.dropdown').dropdown('clear');
      this.loadFilteredData();
    }

    private renderDropdowns() {
      setTimeout(() => {
        $(this.element.nativeElement).find('.ui.dropdown').dropdown();
      });
    }

    private loadFilteredData() {
        this.isLoading = true;
        this.appService.getFilteredRates(this.filterSelect).then(rates => {
          this.rates = rates;
          this.isLoading = false;
          this.renderDropdowns();
        });
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      this.appService.getAllRatesFilters().then(filters => {
        this.filterOptions.origins = filters.origins;
        this.filterOptions.destinations = filters.destinations;
        this.filterOptions.types = filters.types;
        this.filterOptions.accounts = filters.accounts;

          this.appService.getAllRates().then(rates => {
            this.rates = rates;
            this.isLoading = false;
            this.renderDropdowns();
          });
       });
    }

}