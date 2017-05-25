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

	getRate(rate_id:number): Promise<any> {
		let endpoint = '/api/rates/'+rate_id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}
	newRate(): Promise<any> {
		let endpoint = '/api/rates';
		return this.http.post(endpoint, {}).toPromise().then(this.returnJson).catch(this.throwError);
	}
	saveRate(rate:any): Promise<any> {
		let endpoint = '/api/rates/'+rate.id;
		return this.http.post(endpoint, rate).toPromise().then(this.returnJson).catch(this.throwError);
	}
	deleteRate(rate:any): Promise<any> {
		let endpoint = '/api/rates/'+rate.id;
		return this.http.delete(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Quotes
	 *********************** */
	getAllQuotes(): Promise<any> {
		let endpoint = '/api/quotes';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getQuoteById(id:number): Promise<any> {
		let endpoint = '/api/quote/'+id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getFilteredQuotes(filters:any): Promise<any> {
		let endpoint = '/api/quotes/filtered?a=b';
		if (filters.origin) endpoint += '&origin='+filters.origin;
		if (filters.destination) endpoint += '&destination='+filters.destination;
		if (filters.account) endpoint += '&account='+filters.account;
		if (filters.created_at) endpoint += '&created_at='+filters.created_at;
		if (filters.page) endpoint += '&page='+filters.page;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAllQuotesFilters(): Promise<any> {
		let endpoint = '/api/quotes/filters';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	notify(quote_id): Promise<any> {
		let endpoint = '/api/quotes/notify/'+quote_id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Accounts
	 *********************** */
	getAllAccounts(): Promise<any> {
		let endpoint = '/api/accounts';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getUsersByAccountId(id:number): Promise<any> {
		let endpoint = '/api/accounts/'+id+'/users';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getFilteredAccounts(filters:any): Promise<any> {
		let endpoint = '/api/accounts/filtered?a=b';
		if (filters.origin) endpoint += '&origin='+filters.origin;
		if (filters.destination) endpoint += '&destination='+filters.destination;
		if (filters.type) endpoint += '&type='+filters.type;
		if (filters.account) endpoint += '&account='+filters.account;
		if (filters.page) endpoint += '&page='+filters.page;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAllAccountsFilters(): Promise<any> {
		let endpoint = '/api/accounts/filters';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getAccount(account_id:number): Promise<any> {
		let endpoint = '/api/accounts/'+account_id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}
	newAccount(): Promise<any> {
		let endpoint = '/api/accounts';
		return this.http.post(endpoint, {}).toPromise().then(this.returnJson).catch(this.throwError);
	}
	saveAccount(account:any): Promise<any> {
		let endpoint = '/api/accounts/'+account.id;
		return this.http.post(endpoint, account).toPromise().then(this.returnJson).catch(this.throwError);
	}
	deleteAccount(account:any): Promise<any> {
		let endpoint = '/api/accounts/'+account.id;
		return this.http.delete(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	getUser(user_id:number): Promise<any> {
		let endpoint = '/api/users/'+user_id;
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}
	newUser(account_id): Promise<any> {
		let endpoint = '/api/accounts/'+account_id+'/users';
		return this.http.post(endpoint, {}).toPromise().then(this.returnJson).catch(this.throwError);
	}
	saveUser(user:any): Promise<any> {
		let endpoint = '/api/users/'+user.id;
		return this.http.post(endpoint, user).toPromise().then(this.returnJson).catch(this.throwError);
	}
	deleteUser(user:any): Promise<any> {
		let endpoint = '/api/users/'+user.id;
		return this.http.delete(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}

	/*************************
	 * Settings
	 *********************** */
	getSettings(): Promise<any> {
		let endpoint = '/api/settings';
		return this.http.get(endpoint).toPromise().then(this.returnJson).catch(this.throwError);
	}
	saveSettings(settings:any): Promise<any> {
		console.log(settings);
		let endpoint = '/api/settings';
		return this.http.post(endpoint, settings).toPromise().then(this.returnJson).catch(this.throwError);
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