.factory('subscriptionService', function () {
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
        review: function ($scope, status) {

            $scope.classReviewSubscription = "visible-xs visible-sm visible-md visible-lg  ";
            $scope.classBillingAddress = "hidden-xs hidden-sm hidden-md hidden-lg  ";

        }
    };
})