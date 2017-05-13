import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import {Location} from '@angular/common';
import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './accounts-form.template.html',
  styleUrls: ['./accounts-form.styles.scss'],
  providers: [AppService]
})
export class AccountsFormView  {

    private account:any = {};

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
      this.appService.saveAccount(this.account).then(res => {
        this.appService.getAccount(+this.route.snapshot.params['account_id']).then(account => {
          this.account = account;
          this.isLoading = false;
          this.renderDropdowns();
        });
      });
    }

    private delete() {
      this.isLoading = true;
      this.appService.deleteAccount(this.account).then(res => {
         this.router.navigate(['/dashboard/accounts']);
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
      this.appService.getAccount(+this.route.snapshot.params['account_id']).then(account => {
        this.account = account;
        this.isLoading = false;
        this.renderDropdowns();
      });
    }

}