angular
    .module('app.exchange.option.controller')
    .controller('TimeframeController', function TimeframeController ( $scope, OptionCommandService ) {

        var vm = this;

        vm.getExpirationDate = function(timeframe){
            vm.expirationDate = OptionCommandService.getExpirationDate(timeframe);
        };

        $scope.radioModel = {
            '30m': false,
            '90m': true,
            '6h': false,
            '1d': false,
            '7d': false
        };

        $scope.timeframe = '1d';

        $scope.radioModel = vm.radioModel;

        $scope.$watchCollection('radioModel', function () {
            angular.forEach($scope.radioModel, function (value, key) {
                if (value) {
                    $scope.timeframe = key;
                }
            });
        });
    });
