angular
    .module('app.exchange.option.service')
    .factory('PriceFactory', function PriceFactory ($http, $q) {

        var strikePriceUri = '/rest/exchange/strike_price.json';
        var purchasePriceUri = '/rest/exchange/purchase_price.json';

        return {
            getStrikePrice : getStrikePrice,
            getPurchasePrice : getPurchasePrice
        };

        function getStrikePrice ( coinId, expirationDate ) {

            strikePriceUri = strikePriceUri + '?coinId=' + coinId + '&expirationDate=' + expirationDate;
            return $http.get(strikePriceUri)
                .success(function(data) {
                    return data;
                }).error(function (data) {
                    console.log(data);
                    alert('Error @ PriceFactory. Cannot get expiration date at this time.');
                    //NotificationFactory.showError();
                });
        }
        function getPurchasePrice ( timeframe ) {
            return $http.get(expirationDateUri)
                .success(function(data) {
                    return data;
                }).error(function () {
                    alert('Error @ PriceFactory. Cannot get expiration date at this time.');
                    //NotificationFactory.showError();
                });
        }
    });