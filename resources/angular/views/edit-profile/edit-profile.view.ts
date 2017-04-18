import { Component, ElementRef} from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

import 'owl.carousel';

@Component({
  templateUrl: './edit-profile.template.html',
  styleUrls: ['./edit-profile.styles.scss'],
  providers: [AppService]
})
export class EditProfileView  {

    private isLoading:boolean = true;
    private loading_action:string = 'Loading';

    private profile:any;

    private disableCancel:boolean = false;

    constructor(
      private element:ElementRef,
      private router:Router,
      private route:ActivatedRoute,
      private appService:AppService,
      private location:Location
    ) {
    }

    private cancel() {
      this.location.back();
    }

    private save() {
      this.appService.saveProfile(this.profile).then(res => {
          this.router.navigate(['/dashboard'], { preserveQueryParams: true });
      });
    }

    private delete() {
      this.appService.deleteProfile(this.profile).then(res => {
         this.router.navigate(['/dashboard'], { preserveQueryParams: true });
      });
    }

    private renderCarousel() {
      setTimeout(() => {
        $(this.element.nativeElement).find('card').height($(this.element.nativeElement).height()-106);
      });
    }
    
    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
      if (this.route.snapshot.queryParams['cantGoBack'])
        this.disableCancel = true;

      if (this.route.snapshot.params['id'])
        this.appService.getProfile(this.route.snapshot.params['id']).then(res => {
          this.profile = res;
          this.renderCarousel();
          this.isLoading = false;
        });
       else {
         this.profile = {
           red_flags: []
         };
          this.renderCarousel();
          this.isLoading = false;
       }
    }

}