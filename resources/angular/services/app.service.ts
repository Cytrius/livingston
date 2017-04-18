import { Injectable }              from '@angular/core';
import { Http, Response }          from '@angular/http';
import { Observable } from 'rxjs/Observable';

import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';

declare var window:any;

@Injectable()
export class AppService {

	constructor (private http: Http) {}

	/*************************
	 * Profile
	 *********************** */
	getProfiles(filter:any): Promise<any> {
		let endpoint = '/api/profiles?a=b';
		if (filter.limit) endpoint += '&limit='+filter.limit;
		if (filter.page) endpoint += '&page='+filter.page;
		if (filter.query) endpoint += '&query='+filter.query;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getProfile(id:number): Promise<any> {
		let endpoint = '/api/profile/'+id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	newProfile(linkedin:string): Promise<any> {
		let endpoint = '/api/profile/new?linkedin='+linkedin;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	saveProfile(profile:any): Promise<any> {
		let endpoint = '/api/profile';
		if (profile.id) endpoint += '/'+profile.id;
		return this.http.post(endpoint, profile).toPromise().then(this.returnJson).catch(this.throwError);
	}

	deleteProfile(profile:any): Promise<any> {
		let endpoint = '/api/profile';
		if (profile.id) endpoint += '/'+profile.id;
		return this.http.delete(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Callbacks
	 *********************** */
	private returnJson(res:Response) {
		try {
			return Promise.resolve(res.json());
		} catch(e) {
			console.error('Failed to parse the JSON response from the server', res);
			return Promise.reject(res);
		}
	}

	private throwError(error:any) {	
		return Promise.reject(error.message || error);
	}

}