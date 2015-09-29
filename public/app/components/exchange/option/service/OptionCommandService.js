angular
    .module('app.exchange.option.service')
    .factory('OptionCommandService', function OptionCommandService (
        CategoryService, ExpirationDateFactory, SymbolService ) {

        var category = CategoryService ;
        var expiration = ExpirationDateFactory ;
        //var price = PriceFactory ;
        //var state = OptionStateService ;
        var symbol = SymbolService ;
        var expirationDate;

        return {
            getAllCoins : getAllCoins,
            getExpirationDate: getExpirationDate,
            selectSymbol : selectSymbol,
            getLastPrice: getLastPrice
        };

        function getAllCoins (callback) {
            return symbol.getAllCoins(callback);
        }

        function selectSymbol (coin_id, callback) {
            return symbol.selectSymbol(coin_id, callback);
        }

        function getLastPrice (coin_id, callback) {
            return symbol.getLastPrice(coin_id, callback);
        }

        function getExpirationDate (timeframe) {
            expiration
                .getExpirationDate(timeframe)
                .success(function (data) {
                    return expirationDate = data.expiration;
                })
                .error(function () {
                    alert('Error (from OptionCommandService.getExpirationDate() ). Cannot get Coins at this time.');
                });
        }
    });