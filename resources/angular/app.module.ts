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
import { EditProfileView } from '@app/views/edit-profile/edit-profile.view';

/* Common Components */
import { HeaderComponent } from '@app/components/header/header.component';
import { CardComponent } from '@app/components/card/card.component';

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
        EditProfileView,

        /* Components */
        HeaderComponent,
        CardComponent
    ],
    bootstrap:    [ AppComponent ]
})
export class AppModule { }