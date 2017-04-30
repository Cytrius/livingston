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
	 * Rates
	 *********************** */
	getAllRates(): Promise<any> {
		let endpoint = '/api/rates';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getFilteredRates(filters:any): Promise<any> {
		let endpoint = '/api/rates/filtered?a=b';
		if (filters.origin) endpoint += '&origin='+filters.origin;
		if (filters.destination) endpoint += '&destination='+filters.destination;
		if (filters.type) endpoint += '&type='+filters.type;
		if (filters.account) endpoint += '&account='+filters.account;
		if (filters.page) endpoint += '&page='+filters.page;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAllRatesFilters(): Promise<any> {
		let endpoint = '/api/rates/filters';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Quotes
	 *********************** */
	getAllQuotes(): Promise<any> {
		let endpoint = '/api/quotes';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getFilteredQuotes(filters:any): Promise<any> {
		let endpoint = '/api/quotes/filtered?a=b';
		if (filters.origin) endpoint += '&origin='+filters.origin;
		if (filters.destination) endpoint += '&destination='+filters.destination;
		if (filters.account) endpoint += '&account='+filters.account;
		if (filters.created_at) endpoint += '&created_at='+filters.created_at;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAllQuotesFilters(): Promise<any> {
		let endpoint = '/api/quotes/filters';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Accounts
	 *********************** */
	getAllAccounts(): Promise<any> {
		let endpoint = '/api/accounts';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getFilteredAccounts(filters:any): Promise<any> {
		let endpoint = '/api/accounts/filtered?a=b';
		if (filters.origin) endpoint += '&origin='+filters.origin;
		if (filters.destination) endpoint += '&destination='+filters.destination;
		if (filters.type) endpoint += '&type='+filters.type;
		if (filters.account) endpoint += '&account='+filters.account;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAllAccountsFilters(): Promise<any> {
		let endpoint = '/api/accounts/filters';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
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