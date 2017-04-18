import { Pipe, PipeTransform } from '@angular/core';

@Pipe({ name: 'titlecase' })
export class TitlecasePipe implements PipeTransform {
  transform(str:string) {
  	if (!str)
  		return null;
  	else
	    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
  }
}