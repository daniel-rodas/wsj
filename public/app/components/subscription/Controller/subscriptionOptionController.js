.controller('userSubscriptionOptionsCtrl', function ($scope, $window, $rootScope) {

    $scope.setSubscription = function (subscription) {
        $scope.subscription = subscription;
        $rootScope.$broadcast('userOptionChanged', subscription);
    };
    $scope.alertMe = function () {
        setTimeout(function () {
            $window.alert('You\'ve selected the alert tab!');
        });
    };

})