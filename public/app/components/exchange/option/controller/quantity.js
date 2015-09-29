angular
    .module('app.exchange.option.controller')
    .controller('QuantityController', function (OptionCommandService) {
        var vm = this;
        vm.command = OptionCommandService;
    });
