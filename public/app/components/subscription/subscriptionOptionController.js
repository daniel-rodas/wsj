angular
    .module('subscription')
    .controller('SubscriptionOptionsController', function ($scope, $window, $rootScope) {

        $scope.setSubscription = function (subscription) {
            $scope.subscription = subscription;
            $rootScope.$broadcast('UserOptionChangeEvent', subscription);
        };
        $scope.alertMe = function () {
            setTimeout(function () {
                $window.alert('You\'ve selected the alert tab!');
            });
        };

    });