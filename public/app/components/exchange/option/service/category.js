angular
    .module('app.exchange.option.service')
    .factory('CategoryService',function CategoryService () {
        var value;
        return {
            setCategory: setCategory ,
            setTimeframe: setTimeframe ,
            login: function ( value ) {
                return value;
            }
        };
    });