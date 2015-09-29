angular.module('app.exchange.option.controller')
//angular.module('app.exchange.option')
    .controller('CategoryController', function ( OptionCommandService ) {
        var vm = this;


        vm.command = OptionCommandService;

        vm.setCat = function(){

            return vm.command.category.setCategory(vm.radioModel);
        };
    });
