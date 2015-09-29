angular
    .module('app.subscription')
    //.module('app.common')
    .controller('SubscriptionOptionsController', function ( $window, $rootScope) {

        this.setSubscription = function (subscription) {
            this.subscription = subscription;
            $rootScope.$broadcast('UserOptionChangeEvent', subscription);
        };
        this.alertMe = function () {
            setTimeout(function () {
                $window.alert('You\'ve selected the alert tab!');
            });
        };

    });