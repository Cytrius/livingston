import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

@Component({
  templateUrl: './users.template.html',
  styleUrls: ['./users.styles.scss'],
  providers: [AppService]
})
export class UsersView  {

    private users:any[];

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

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
        this.appService.getUsersByAccountId(+this.route.snapshot.params['id']).then(users => {
          this.users = users;
          this.isLoading = false;
          this.renderDropdowns();
        });
    }

}