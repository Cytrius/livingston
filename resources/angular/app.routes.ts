import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardView } from '@app/views/dashboard/dashboard.view';
import { QuotesView } from '@app/views/quotes/quotes.view';

import { RatesView } from '@app/views/rates/rates.view';
import { RatesFormView } from '@app/views/rates-form/rates-form.view';
import { AccountsView } from '@app/views/accounts/accounts.view';
import { AccountsFormView } from '@app/views/accounts-form/accounts-form.view';
import { UsersView } from '@app/views/users/users.view';
import { UsersFormView } from '@app/views/users-form/users-form.view';

import { SettingsView } from '@app/views/settings/settings.view';

const routes: Routes = [

	{ path: 'dashboard/quotes', component: DashboardView},
	{ path: 'dashboard/quotes/:id', component: QuotesView},
	{ path: 'dashboard/rates', component: RatesView },
	{ path: 'dashboard/rates/:rate_id/edit', component: RatesFormView },
	{ path: 'dashboard/accounts', component: AccountsView },
	{ path: 'dashboard/accounts/:account_id', component: UsersView },
	{ path: 'dashboard/accounts/:account_id/edit', component: AccountsFormView },
	{ path: 'dashboard/accounts/:account_id/users/:user_id/edit', component: UsersFormView },
	{ path: 'dashboard/settings', component: SettingsView }
];

export const routing: ModuleWithProviders = RouterModule.forRoot(routes);