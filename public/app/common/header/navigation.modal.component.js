"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var ng_bootstrap_1 = require('@ng-bootstrap/ng-bootstrap');
var NavigationModalComponent = (function () {
    function NavigationModalComponent(modalService) {
        this.modalService = modalService;
        // get main section categories, then populate top level navigation links
        this._navSectionCategoryUriString = '/blog/rest/navigation/navSectionCategories.json';
    }
    NavigationModalComponent.prototype.open = function (content) {
        var _this = this;
        this.modalService.open(content).result.then(function (result) {
            _this.closeResult = "Closed with: " + result;
        }, function (reason) {
            _this.closeResult = "Dismissed " + _this.getDismissReason(reason);
        });
    };
    NavigationModalComponent.prototype.getDismissReason = function (reason) {
        if (reason === ng_bootstrap_1.ModalDismissReasons.ESC) {
            return 'by pressing ESC';
        }
        else if (reason === ng_bootstrap_1.ModalDismissReasons.BACKDROP_CLICK) {
            return 'by clicking on a backdrop';
        }
        else {
            return "with: " + reason;
        }
    };
    Object.defineProperty(NavigationModalComponent.prototype, "navSectionCategoryUriString", {
        get: function () {
            return this._navSectionCategoryUriString;
        },
        set: function (value) {
            this._navSectionCategoryUriString = value;
        },
        enumerable: true,
        configurable: true
    });
    NavigationModalComponent = __decorate([
        core_1.Component({
            selector: 'rn-navigation-modal',
            templateUrl: '/angular/template/navigation_modal'
        }), 
        __metadata('design:paramtypes', [ng_bootstrap_1.NgbModal])
    ], NavigationModalComponent);
    return NavigationModalComponent;
}());
exports.NavigationModalComponent = NavigationModalComponent;
//# sourceMappingURL=navigation.modal.component.js.map