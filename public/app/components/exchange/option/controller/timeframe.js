angular
    .module('app.exchange.option.controller')
    .controller('TimeframeController', function TimeframeController ($scope, OptionCommandService, ExpirationDateFactory ) {

        var vm = this;
        vm.expirationDate = OptionCommandService.getExpirationDate;

        $scope.radioModel = {
            '30m': false,
            '90m': true,
            '6h': false,
            '1d': false,
            '7d': false
        };

        $scope.timeframe = '1d';

        $scope.radioCategories = vm.radioModel;

        $scope.$watchCollection('radioModel', function () {
            angular.forEach($scope.radioModel, function (value, key) {
                if (value) {
                    $scope.timeframe = key;
                }
            });
        });

        ExpirationDateFactory
            .getExpirationDate($scope.timeframe)
            .success(function (data) {

                vm.expirationDate = data.expiration;
            })
            .error(function () {
                alert('Error (from StateService.getExpirationDate). Cannot get expiration date at this time.');
            });
    });
