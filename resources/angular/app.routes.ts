import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardView } from '@app/views/dashboard/dashboard.view';
import { RatesView } from '@app/views/rates/rates.view';
import { AccountsView } from '@app/views/accounts/accounts.view';

const routes: Routes = [
	{ path: 'dashboard/quotes', component: DashboardView},
	{ path: 'dashboard/rates', component: RatesView },
	{ path: 'dashboard/accounts', component: AccountsView }
];

export const routing: ModuleWithProviders = RouterModule.forRoot(routes);