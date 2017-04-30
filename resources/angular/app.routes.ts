import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardView } from '@app/views/dashboard/dashboard.view';
import { QuotesView } from '@app/views/quotes/quotes.view';
import { RatesView } from '@app/views/rates/rates.view';
import { AccountsView } from '@app/views/accounts/accounts.view';
import { UsersView } from '@app/views/users/users.view';
import { SettingsView } from '@app/views/settings/settings.view';

const routes: Routes = [
	{ path: 'dashboard/quotes', component: DashboardView},
	{ path: 'dashboard/quotes/:id', component: QuotesView},
	{ path: 'dashboard/rates', component: RatesView },
	{ path: 'dashboard/accounts', component: AccountsView },
	{ path: 'dashboard/accounts/:id', component: UsersView },
	{ path: 'dashboard/settings', component: SettingsView }
];

export const routing: ModuleWithProviders = RouterModule.forRoot(routes);