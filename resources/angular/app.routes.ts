import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardView } from '@app/views/dashboard/dashboard.view';

const routes: Routes = [
	{ path: 'dashboard', component: DashboardView}
];

export const routing: ModuleWithProviders = RouterModule.forRoot(routes);