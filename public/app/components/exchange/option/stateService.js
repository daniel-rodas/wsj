angular
    .module('app.exchange.option')
    .factory('StateService', function () {
        //this.price;
        //this.quantity;
        var category ;
        var timeframe;
        var coinName ;
        //this.askPrice;
        //this.strikePrice;
        //this.lastPrice;
        //this.expiration;

        return {

            getCategory: function ( ) {

                return category;
            },
            getTimeframe: function (  ) {

                return timeframe;
            },
            getCoinName: function (  ) {

                return coinName;
            },
            setCategory: function ( item ) {

                category = item;
            },
            setTimeframe: function ( item ) {

                timeframe = item;
            },
            setCoinName: function ( item ) {

                coinName = item;
            }
        };
    });