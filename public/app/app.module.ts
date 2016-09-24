import { NgModule }                     from '@angular/core';
import { BrowserModule }                from '@angular/platform-browser';
import { FormsModule }                  from '@angular/forms';
import { NgbModule }                    from '@ng-bootstrap/ng-bootstrap';

import { AppComponent }                 from './app.component';
import { NavigationComponent }          from './navigation.component';
import { WhatsNewsComponent }           from './components/whatsNews/whats.news.component';
import { NavigationModalComponent }     from './common/header/navigation.modal.component';
import { NavigationUserSettingOptionDropdown }     from './common/header/navigation.user.setting.option.dropdown.component';

@NgModule({
    imports:      [ BrowserModule, FormsModule, NgbModule ],
    declarations: [ AppComponent, NavigationModalComponent, WhatsNewsComponent, NavigationUserSettingOptionDropdown ],
    bootstrap:    [ AppComponent, NavigationModalComponent, WhatsNewsComponent, NavigationUserSettingOptionDropdown ]
})

export class AppModule { }