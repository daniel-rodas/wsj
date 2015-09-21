angular
    .module('app.exchange.option.service')
    .factory('ExpirationDateFactory', function ExpirationDateFactory ($http, $q) {

        var expirationDateUri = '/rest/exchange/expiration_date.json?timeframe=';
        return {

            getExpirationDate : getExpirationDate

        };

        function getExpirationDate ( timeframe ) {
            expirationDateUri = expirationDateUri + timeframe;

            return $http.get(expirationDateUri)
                .success(function(data) {
                    return data;
                }).error(function () {
                    alert('Error @ ExpirationDateFactory. Cannot get expiration date at this time.');
                    //NotificationFactory.showError();
                });
        }
    });