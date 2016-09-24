import { Component } from '@angular/core';
import {NgbModal, ModalDismissReasons} from '@ng-bootstrap/ng-bootstrap';

@Component({
    selector: 'rn-navigation-modal',
    templateUrl: '/angular/template/navigation_modal'
})

export class NavigationModalComponent {
    closeResult: string;

    constructor(private modalService: NgbModal) {}

    open(content) {
        this.modalService.open(content).result.then((result) => {
            this.closeResult = `Closed with: ${result}`;
        }, (reason) => {
            this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
        });
    }

    private getDismissReason(reason: any): string {
        if (reason === ModalDismissReasons.ESC) {
            return 'by pressing ESC';
        } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
            return 'by clicking on a backdrop';
        } else {
            return  `with: ${reason}`;
        }
    }

    get navSectionCategoryUriString(): string {
        return this._navSectionCategoryUriString;
    }

    set navSectionCategoryUriString(value: string) {
        this._navSectionCategoryUriString = value;
    }

    // get main section categories, then populate top level navigation links
    private _navSectionCategoryUriString = '/blog/rest/navigation/navSectionCategories.json';

    // protected uriPath = "";
    // uriPath = window.location.pathname;
    // uriPath = uriPath.slice(1, path.length);
    //
    // uriPath  = "/blog/rest/navigation/navSubCategories.json?slugType=post&slug=" + uriPath;
}