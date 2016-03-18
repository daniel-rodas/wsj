angular
    .module('app.exchange.option.service')
    .factory('OptionCommandService', function OptionCommandService (
        CategoryService, ExpirationDateFactory, SymbolService,
        PriceFactory
    ) {

        var category = CategoryService ;
        var expiration = ExpirationDateFactory ;
        var price = PriceFactory ;
        //var state = OptionStateService ;
        var symbol = SymbolService ;

        return {
            getAllCoins : getAllCoins,
            getExpirationDate: getExpirationDate,
            selectSymbol : selectSymbol,
            getLastPrice: getLastPrice,
            getPurchasePrice : getPurchasePrice,
            getStrikePrice : getStrikePrice
        };

        function getAllCoins (callback) {
            return symbol.getAllCoins(callback);
        }

        function getStrikePrice ( coinId, expirationDate, callback ){
            return price.getStrikePrice ( coinId, expirationDate, callback );
        }

        function selectSymbol (coin_id, callback) {
            return symbol.selectSymbol(coin_id, callback);
        }

        function getLastPrice (coin_id, callback) {
            return symbol.getLastPrice(coin_id, callback);
        }

        function getExpirationDate (timeframe, callback) {
            return expiration.getExpirationDate(timeframe, callback);
        }

        function getPurchasePrice ( optionType, quantity, strikePrice, coinId, callback )
        {
            return price.getPurchasePrice ( optionType, quantity, strikePrice, coinId, callback );
        }
    });