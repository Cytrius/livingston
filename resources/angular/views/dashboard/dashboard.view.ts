import { Component, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { AppService } from '@app/services/app.service';

declare var $:any;
declare var window:any;

import 'owl.carousel';

@Component({
  templateUrl: './dashboard.template.html',
  styleUrls: ['./dashboard.styles.scss'],
  providers: [AppService]
})
export class DashboardView  {

    private profiles:any[];

    private isEmpty:boolean = false;
    private empty_action:string = 'No Results';

    private isLoading:boolean = true;
    private loading_action:string = 'Loading';

    private activeProfileIndex:number = 0;

    private results:any = {
      count:0,
      all:0,
      from:0,
      to:0
    };

    private filter:any = {
      limit:10,
      page:1
    }

    constructor(
      private element:ElementRef,
      private router:Router,
      private route:ActivatedRoute,
      private appService:AppService
    ) {
    }

    private renderCarousel() {
      setTimeout(() => {
        console.log('renderCarousel()', $(this.element.nativeElement).find('card'))
        $(this.element.nativeElement).find('card').height($(this.element.nativeElement).height()-106);
        $('.owl-carousel').owlCarousel({
          items:1,
          center:true
        });
        $('.owl-carousel').trigger('refresh.owl.carousel');
        if (this.filter.index) {
          console.log('go to', this.filter.index);
          let owl = $('.owl-carousel');
          owl.trigger('to.owl.carousel', [this.filter.index, 0]);
          this.activeProfileIndex = +this.filter.index;
        }
      });
    }

    private edit() {
      let index = 0;
      if ($(this.element.nativeElement).find('.owl-item.active card').length) {
        index = $(this.element.nativeElement).find('.owl-item.active card').attr('index');
      }
      console.log('index', index);
      this.router.navigate(['/dashboard/edit', this.profiles[index].id]);
    }

    private nextProfile() {
      let owl = $('.owl-carousel');
      owl.trigger('next.owl.carousel');

      setTimeout(() => {
        let index = 0;
        if ($(this.element.nativeElement).find('.owl-item.active card').length) {
          index = $(this.element.nativeElement).find('.owl-item.active card').attr('index');
        }
        this.activeProfileIndex = +index;
        this.router.navigate([], { queryParams: { 
          index:this.activeProfileIndex, 
          id:this.profiles[this.activeProfileIndex].id,
          page:this.filter.page
        }});

        if (this.activeProfileIndex === (this.filter.page*this.filter.limit)-1) {
          this.filter.page++;
          this.filter.index = this.activeProfileIndex;
          this.loadData(true);
        }
      });
    }

    private previousProfile() {
      let owl = $('.owl-carousel');
      owl.trigger('prev.owl.carousel');

      setTimeout(() => {
        let index = 0;
        if ($(this.element.nativeElement).find('.owl-item.active card').length) {
          index = $(this.element.nativeElement).find('.owl-item.active card').attr('index');
        }
        this.activeProfileIndex = +index;
                this.router.navigate([], { queryParams: { 
          index:this.activeProfileIndex, 
          id:this.profiles[this.activeProfileIndex].id,
          page:this.filter.page
        }});
      });
    }

    private loadData(background?:boolean) {
      if (!background) this.isLoading = true;
       $('.owl-carousel').owlCarousel('destroy');
      setTimeout(() => {
        this.appService.getProfiles(this.filter).then(res => {
          if (!this.profiles || !this.profiles.length)
            this.profiles = res.profiles;
          else
            this.profiles = this.profiles.concat(res.profiles);

          if (!this.profiles || this.profiles.length < 1)
            this.isEmpty = true;
          else
            this.isEmpty = false;

          console.log('Profiles', this.profiles);

          this.results.count = res.count;
          this.results.all = res.all_count;
          this.results.from = res.from;
          this.results.to = res.to;
          this.renderCarousel();
          this.isLoading = false;
        });
      });
    }


    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {

      if (this.route.snapshot.params['query'] && this.route.snapshot.params['query'] !== '') {
        this.filter.query = this.route.snapshot.params['query'];
      } else {
        this.filter.query  = null;
      }

      if (this.route.snapshot.queryParams['page'])
        this.filter.page = this.route.snapshot.queryParams['page'];

      if (this.route.snapshot.queryParams['index'])
        this.filter.index = this.route.snapshot.queryParams['index'];

      this.route.params.subscribe(params => {
          if (params['query'] && params['query'] !== '') {
            this.filter.query = params['query'];
          } else {
            this.filter.query  = null;
          }
          this.profiles = [];
          $('.owl-carousel').owlCarousel('destroy');
          this.loadData();
      });
    }

}