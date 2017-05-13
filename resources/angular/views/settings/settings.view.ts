import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './settings.template.html',
  styleUrls: ['./settings.styles.scss'],
  providers: [AppService]
})
export class SettingsView  {

    private settings:any = {};

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

    private save() {
      this.isLoading = true;
      console.log(this.settings);
      this.appService.saveSettings(this.settings).then(res => {
         this.appService.getSettings().then(settings => {
          this.settings = settings;
          this.isLoading = false;
        });
      });
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

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {

      this.appService.getSettings().then(settings => {

          this.settings = settings;
          this.isLoading = false;
          this.renderDropdowns();
          this.renderDatepicker();
      });
    }
}