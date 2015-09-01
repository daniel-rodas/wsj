angular
    .module('app.common')
    .controller('WhatsNewsController', function () {
        this.class = "hidden-xs hidden-sm ";
        this.changeClass = function () {
            if (this.class === "") {
                this.class = "hidden-xs hidden-sm ";
            }
            else {
                this.class = "";
            }
        }
    });