angular.module('app.exchange.option.controller')
    .controller('CreateController', function CreateController (OptionStateService) {
        var vm = this;
        //vm.command = OptionCommandService;

        vm.state = OptionStateService;

        vm.start = function (){

            vm.state.start();
        };

        //vm.timeframe = this.state.getTimeframe();
        //vm.category = this.state.getCategory();
        //vm.coinName = this.state.getCoinName();
        //
        //
        //vm.command
        //    .getStrikePrice(4,'1442368224')
        //    .success(function (data) {
        //        vm.strikePrice = data.strikePrice;
        //    })
        //    .error(function () {
        //        alert('Error (from CreateController). Cannot get expiration date at this time.');
        //    });
    });
