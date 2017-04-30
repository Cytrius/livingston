import { NgModule, ErrorHandler, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';
import { HttpModule } from '@angular/http';

/* Common App */
import { AppComponent }  from '@app/app.component';

/* Common Modules */
import { routing } from '@app/app.routes';

/* Common Views */
import { DashboardView } from '@app/views/dashboard/dashboard.view';
import { QuotesView } from '@app/views/quotes/quotes.view';
import { RatesView } from '@app/views/rates/rates.view';
import { AccountsView } from '@app/views/accounts/accounts.view';
import { UsersView } from '@app/views/users/users.view';
import { SettingsView } from '@app/views/settings/settings.view';

/* Common Components */
import { HeaderComponent } from '@app/components/header/header.component';

@NgModule({
    imports: [
        routing,
        BrowserModule,
        FormsModule,
        HttpModule
    ],
    schemas: [
        CUSTOM_ELEMENTS_SCHEMA
    ],
    declarations: [
        /* App Component */
        AppComponent,
        
        /* Common Views */
        DashboardView,
        QuotesView,
        RatesView,
        AccountsView,
        UsersView,
        SettingsView,

        /* Components */
        HeaderComponent
    ],
    bootstrap:    [ AppComponent ]
})
export class AppModule { }