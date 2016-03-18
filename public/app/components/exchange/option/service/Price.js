angular
    .module('app.exchange.option.service')
    .factory('PriceFactory', function PriceFactory ($http) {

        var strikePriceUri = '/rest/exchange/strike_price.json';
        var purchasePriceUri = '/rest/exchange/purchase_price.json';

        return {
            getStrikePrice : getStrikePrice,
            getPurchasePrice : getPurchasePrice
        };

        function getStrikePrice ( coinId, expirationDate, callback ) {
            strikePriceUri = strikePriceUri + '?coinId=' + coinId + '&expirationDate=' + expirationDate;
            return $http.get(strikePriceUri).then(callback);
        }
        function getPurchasePrice ( optionType, quantity, strikePrice, coinId, callback ) {

            return $http.get(purchasePriceUri,
                {
                    params : {
                        option_type : optionType,
                        quantity : quantity,
                        strike_price : strikePrice,
                        coin_id : coinId
                    }
                }).then(callback);
        }
    });