angular
    .module('app.exchange.option.service')
    .factory('OptionCommandService', function OptionCommandService (ExpirationDateFactory) {

        var quantity;
        var expirationDate ;
        var category ;
        var timeframe;
        var coinName ;
        var askPrice;
        var strikePrice;
        var lastPrice;
        var expiration;

        return {
            getExpirationDate: getExpirationDate ,
            getCategory: getCategory ,
            getTimeframe: getTimeframe ,
            getCoinName: getCoinName ,
            setExpirationDate: setExpirationDate ,
            setCoinName:  setCoinName
        };

        function getExpirationDate (timeFrame) {
            ExpirationDateFactory
                .getExpirationDate(timeframe)
                .success(function (data) {
                    expirationDate = data.expiration;
                })
                .error(function () {
                    alert('Error (from StateService.getExpirationDate). Cannot get expiration date at this time.');
                });
        }

        function getCategory ( ) {

            return category;
        }

        function getTimeframe (  ) {

            return timeframe;
        }

        function getCoinName (  ) {

            return coinName;
        }

        function setExpirationDate ( item ) {

            expirationDate = item;
        }
        function setCategory ( item ) {

            category = item;
        }

        function setTimeframe ( item ) {

            timeframe = item;
        }

        function  setCoinName ( item ) {

            coinName = item;
        }
    });