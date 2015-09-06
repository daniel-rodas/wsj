angular
    .module('app.exchange')
    .controller('CategoryController', function () {



        this.radioModel = {
            put: false,
            call: true,
            short: false,
            future: false
        };
    });
