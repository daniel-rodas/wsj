angular
    .module('app.subscription')
    .factory('SubscriptionService', function () {
        var option;
        var beginning = 1;
        var ending;
        return {

            setBeginning: function (beginning) {

                return beginning = beginning;

            },
            getBeginning: function () {

                return beginning;
            },
            setEnding: function (ending) {

                return ending = ending;

            },
            getEnding: function () {

                return ending;
            },
            setOption: function (option) {

                return option = option;

            },
            getOption: function () {

                return option;
            },
            review: function (status) {

                this.classReviewSubscription = "visible-xs visible-sm visible-md visible-lg  ";
                this.classBillingAddress = "hidden-xs hidden-sm hidden-md hidden-lg  ";

            }
        };
    });