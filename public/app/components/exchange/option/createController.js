angular.module('app.exchange.option')
    .controller('CreateController', function CreateController (StateService, ExpirationDateFactory, PriceFactory) {
        var vm = this;
        vm.state = StateService;
        vm.timeframe = this.state.getTimeframe();
        vm.category = this.state.getCategory();
        vm.coinName = this.state.getCoinName();
        ExpirationDateFactory
            .getExpirationDate('1d')
            .success(function (data) {
                console.log('From CreateController');
                console.log(data.expiration);
                vm.expirationDate = data.expiration;
            })
            .error(function () {
                alert('Error (from CreateController). Cannot get expiration date at this time.');
            });

        PriceFactory
            .getStrikePrice(4,'1442368224')
            .success(function (data) {
                console.log('From CreateController');
                console.log(data.expiration);
                vm.strikePrice = data.strikePrice;
            })
            .error(function () {
                alert('Error (from CreateController). Cannot get expiration date at this time.');
            });
    });
