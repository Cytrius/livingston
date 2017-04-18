import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardView } from '@app/views/dashboard/dashboard.view';
import { EditProfileView } from '@app/views/edit-profile/edit-profile.view';

const routes: Routes = [
	{ path: 'dashboard',  component: DashboardView},
	{ path: 'dashboard/search',  component: DashboardView},
	{ path: 'dashboard/search/:query',  component: DashboardView},
	{ path: 'dashboard/new',  component: EditProfileView},
	{ path: 'dashboard/edit/:id',  component: EditProfileView},
];

export const routing: ModuleWithProviders = RouterModule.forRoot(routes);