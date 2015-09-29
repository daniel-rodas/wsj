angular.module('app.exchange.symbol.controller')
    .controller('SymbolController', function ( OptionCommandService ) {

        var vm = this;
        vm.command = OptionCommandService;

        vm.selectSymbol = function (coin_id)
        {
            vm.command.selectSymbol(coin_id, function (response){
                vm.coin = response.data[0];

                vm.command.getLastPrice(coin_id, function (response){
                    vm.coin.lastPrice = response.data[0];
                });
            });
        };

        vm.command.getAllCoins(function (response) {
            vm.coins =  response.data[0];
        });
    });
