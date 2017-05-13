import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './accounts.template.html',
  styleUrls: ['./accounts.styles.scss'],
  providers: [AppService]
})
export class AccountsView  {

    private accounts:any[];

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
      page: 0
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

    private create() {
       this.isLoading = true;
       this.appService.newAccount().then(account => {
         this.router.navigate(['/dashboard/accounts', account.id, 'edit']);
       });
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
        this.appService.getFilteredAccounts(this.filterSelect).then(accounts => {
          this.accounts = accounts;
          this.isLoading = false;
          this.renderDropdowns();
        });
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      this.appService.getAllAccountsFilters().then(filters => {
        this.filterOptions.origins = filters.origins;
        this.filterOptions.destinations = filters.destinations;
        this.filterOptions.types = filters.types;
        this.filterOptions.accounts = filters.accounts;

          this.appService.getAllAccounts().then(accounts => {
            this.accounts = accounts;
            this.isLoading = false;
            this.renderDropdowns();
          });
       });
    }

}