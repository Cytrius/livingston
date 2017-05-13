import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import {Location} from '@angular/common';
import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './users-form.template.html',
  styleUrls: ['./users-form.styles.scss'],
  providers: [AppService]
})
export class UsersFormView  {

    private user:any = {};

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
      this.appService.saveUser(this.user).then(res => {
        this.appService.getUser(+this.route.snapshot.params['user_id']).then(user => {
          this.user = user;
          this.isLoading = false;
          this.renderDropdowns();
        });
      });
    }

    private delete() {
      this.isLoading = true;
      this.appService.deleteUser(this.user).then(res => {
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
      this.appService.getUser(+this.route.snapshot.params['user_id']).then(user => {
        this.user = user;
        this.isLoading = false;
        this.renderDropdowns();
      });
    }

}