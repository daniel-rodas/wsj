angular
    .module('app.exchange.option')
    .factory('CategoryDirective', function () {
        var value;
        return {

            login: function ( value ) {
                return value;
            }
        };
    });