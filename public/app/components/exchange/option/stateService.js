angular
    .module('app.exchange')
    .factory('OptionStateService', function () {
        var price;
        var quantity;
        var category;
        var timeframe;
        var coin;
        var askPrice;
        var strikePrice;
        var lastPrice;
        var expiration;

        return {

            login: function ( username, password ) {
                console.log(username);
                return username;
            }
        };
    });