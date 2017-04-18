import { Component, Input, Output, EventEmitter, ElementRef } from '@angular/core';

declare var $:any;

@Component({
  selector: 'card',
  templateUrl: './card.template.html',
  styleUrls: ['./card.styles.scss'],
  inputs: ['profile', 'edit']
})
export class CardComponent  {

  private profile:any;
  private edit:boolean = false;

  private onSave:EventEmitter<any> = new EventEmitter();

  private actionOpen:boolean = false;
  private hoverAction:string = '';

  private details:any = {
    notes:null,
    daily_life:null,
    demographic:null,
    goals:null,
    story:null,
    objections:null,
    red_flags:null
  };

    constructor(
      private element:ElementRef,
    ) {
    }

    private renderElements() {
      setTimeout(() => {
          $('[name="profile_keywords"]').parents('.ui.dropdown').dropdown({
              allowAdditions: true,
              className: {
                label: 'ui small label'
              },
              onChange: val => this.profile.keywords = val
          });
          $('[name="skills"]').parents('.ui.dropdown').dropdown({
              allowAdditions: true,
              className: {
                label: 'ui small label'
              },
              onChange: val => this.profile.skills = val
          });
      });
    }

    private addFlag() {
      this.profile.red_flags.push('');
    }

    private addDetails() {
      if (!this.actionOpen) {
        this.actionOpen = true;
        $('.hover-text').fadeOut(100, () => {
          $('.hover-text-2').css({visibility:'visible'});
          this.fadeInRecursive(0, 7)
        });
      } else {
        this.actionOpen = false;
        this.fadeOutRecursive(7);
      }
    }

    private fadeInRecursive(index, total) {
      if (index !== total)
        $($('.segment.scroll.edit .button.inactive')[index]).fadeIn(50, () => {
            this.fadeInRecursive(index+1, total);
        });
      else  
        return;
    }

    private fadeOutRecursive(index) {
      if (index !== 0)
        $($('.segment.scroll.edit .button.inactive')[index-1]).fadeOut(50, () => {
            this.fadeOutRecursive(index-1);
        });
      else {
        $('.hover-text-2').css({visibility:'hidden'});
        $('.hover-text').fadeIn(100);
      }
    }

    private removeDetails(detail:string) {
      if (detail === 'red_flags')
        this.profile.red_flags = [];
      else
        this.details[detail] = false;
    }

    private addDetailsSegment(detail:string) {
        this.addDetails();
        if (detail === 'red_flags') {
          this.profile.red_flags = [''];
          setTimeout(() => {
            $('input[raw_name="red_flag_0"]').focus()
          });
        } else {
        this.details[detail] = true;
          setTimeout(() => {
            $('textarea[name="'+detail+'"]').focus()
          });
        }
    }

    customTrackBy(index: number, obj: any): any {
      return index;
    }

    isArray(val) { return typeof val === 'array' || typeof val === 'object'; }

    ngOnChanges(changes) {
      if (changes['profile']) {
        if (
          ( 
            (changes['profile'].previousValue && !changes['profile'].previousValue.name)
            || !changes['profile'].previousValue ) 
          && (changes['profile'].currentValue && changes['profile'].currentValue.name)) 
        {
          this.renderElements();
          if (!this.profile.red_flags)
            this.profile.red_flags = [];
          if (typeof this.profile.skills === 'string' && !this.edit)
            this.profile.skills = this.profile.skills.split(',');
          if (typeof this.profile.keywords === 'string' && !this.edit)
            this.profile.keywords = this.profile.keywords.split(',');

          for(let key of Object.keys(this.details)) {
            if (this.profile[key])
              this.details[key] = this.profile[key];
          }

          console.log(this.profile);
        }
      }
    }

    /**
     * On Component Initialize - Request the navigation json
     */
    ngOnInit() : void {
        if (this.edit)
          this.renderElements();
    }

}