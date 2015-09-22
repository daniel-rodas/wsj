angular.module('app.exchange.option.controller')
    .controller('CreateController', function CreateController (OptionCommandService,  PriceFactory) {
        var vm = this;
        vm.state = OptionCommandService;
        vm.timeframe = this.state.getTimeframe();
        vm.category = this.state.getCategory();
        vm.coinName = this.state.getCoinName();


        PriceFactory
            .getStrikePrice(4,'1442368224')
            .success(function (data) {
                vm.strikePrice = data.strikePrice;
            })
            .error(function () {
                alert('Error (from CreateController). Cannot get expiration date at this time.');
            });
    });
