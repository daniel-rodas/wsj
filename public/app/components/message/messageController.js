.controller('AlertMessageCtrl', function ($scope, $rootScope, messageService) {
    $scope.alerts = null;

    $scope.addAlert = function () {
        $scope.alerts.push({msg: 'Another alert!'});
    };

    $scope.closeAlert = function (index) {
        $scope.alerts.splice(index, 1);
    };

    $scope.$on('userChanged', function (event, message) {
        console.log(event);

        $scope.alerts = [
            {type: 'info', msg: 'Oh snap! Something different is happening again.'},
            {type: 'warning', msg: message}
        ];
    });
})