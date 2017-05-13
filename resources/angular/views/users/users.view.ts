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

    private account_id:number;

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
       this.appService.newUser(this.account_id).then(user => {
         this.router.navigate(['/dashboard/accounts', user.account_id, 'users', user.id, 'edit']);
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
      this.account_id = +this.route.snapshot.params['account_id'];
        this.appService.getUsersByAccountId(+this.route.snapshot.params['account_id']).then(users => {
          this.users = users;
          this.isLoading = false;
          this.renderDropdowns();
        });
    }

}