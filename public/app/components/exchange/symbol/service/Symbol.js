angular
    .module('app.exchange.symbol.service')
    .factory('SymbolService',function SymbolService ($http) {

        var Uri = '/rest/exchange/all_coins.json';

        return {
            getAllCoins: getAllCoins,
            selectSymbol: selectSymbol,
            getLastPrice: getLastPrice
        };

        function getAllCoins (callback) {
            return $http.get(Uri).then(callback);
        }

        function selectSymbol(coin_id, callback)
        {
            var Uri = '/rest/exchange/coin.json?coin_id=';
            Uri = Uri + coin_id;
            return $http.get(Uri).then(callback);
        }
        function getLastPrice(coin_id, callback)
        {
            var Uri = '/rest/exchange/last_price.json?coin_id=';
            Uri = Uri + coin_id;
            return $http.get(Uri).then(callback);
        }
    });