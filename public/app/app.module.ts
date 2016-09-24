import { NgModule }             from '@angular/core';
import { BrowserModule }        from '@angular/platform-browser';
import { FormsModule }          from '@angular/forms';
import { NgbModule }            from '@ng-bootstrap/ng-bootstrap';

import { AppComponent }         from './app.component';
import { NavigationComponent }  from './navigation.component';
import { WhatsNewsComponent }   from './components/whatsNews/whats.news.component';
//, NgbModule
@NgModule({
    imports:      [ BrowserModule, FormsModule  ],
    declarations: [ AppComponent, NavigationComponent, WhatsNewsComponent  ],
    bootstrap:    [ AppComponent, NavigationComponent, WhatsNewsComponent ]
})

export class AppModule { }