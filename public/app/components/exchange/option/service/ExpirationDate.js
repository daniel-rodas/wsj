angular
    .module('app.exchange.option.service')
    .factory('ExpirationDateFactory', function ExpirationDateFactory ($http, $q) {

        var expirationDateUri = '/rest/exchange/expiration_date.json?timeframe=';
        return {

            getExpirationDate : getExpirationDate

        };

        function getExpirationDate ( timeframe, callback ) {
            expirationDateUri = expirationDateUri + timeframe;

            return $http.get(expirationDateUri).then(callback);
        }
    });