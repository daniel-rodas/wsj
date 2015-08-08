angular
    .module('authentication')
    .controller('AuthenticationController', function ($scope, $rootScope, messageService, subscriptionService) {

    $scope.step = 1;
    $scope.$on('UserOptionChangeEvent', function (event, message) {
        console.log(event);

        $scope.subscription = message;
    });

    $scope.templateUrl = "register.html";

    $scope.checkboxModel = {
        value1 : true,
        value2 : 'YES'
    };

    $scope.nextButton = "Continue";
    $scope.class = "";


    $scope.resetView = function ()
    {
        $scope.classBasicInfo = "hidden-xs hidden-sm hidden-md hidden-lg ";
        $scope.classDeliveryAddress = "hidden-xs hidden-sm hidden-md hidden-lg ";
        $scope.classBillingAddress = "hidden-xs hidden-sm hidden-md hidden-lg ";
        $scope.classReviewSubscription = "hidden-xs hidden-sm hidden-md hidden-lg ";
        $scope.classSubscriptionComplete = "hidden-xs hidden-sm hidden-md hidden-lg ";
    };

    $scope.getViewByClass = function (classString)
    {
        $scope[classString] = "visible-xs visible-sm visible-md visible-lg ";
    };

    $scope.resetView();
    $scope.getViewByClass('classBasicInfo');

    subscriptionService.setEnding(4);
    $scope.back = function()
    {
        // If at beginning do not go decrement step
        if($scope.step < subscriptionService.getBeginning() + 2)
        {
            $scope.step = 1;
            $scope.resetView();
            $scope.getViewByClass('classBasicInfo');
        }
        if($scope.step != subscriptionService.getBeginning())
        {
            $scope.step = $scope.step - 2;

            $scope.changeContinue($scope.step);
        }
    };
    $scope.skip = function()
    {
        // If at ending do not go increment step
        if($scope.step != subscriptionService.getEnding())
        {
            $scope.changeContinue();
        }
    };
    $scope.changeContinue = function () {
        var view1 = function (){
            if ($scope.subscription != 'digital')
            {
                // Show Delivery address
                $scope.step = 2;
                $scope.resetView();
                $scope.getViewByClass('classDeliveryAddress');
            }
            else
            {
                // Subscription is Digital!
                // Skip Step 2
                $scope.step = 3;
                $scope.resetView();
                $scope.getViewByClass('classBillingAddress');
            }
        };

        switch($scope.step) {
            case 1:
                // Basic info
                return view1();
                break;
            case 2:
                //code block
                // show Billing Fieldset
                $scope.step = 3;
                $scope.resetView();
                $scope.getViewByClass('classBillingAddress');

                break;

            case 3:
                //code block
                $scope.step = 4;
                $scope.nextButton = "Confirm";
                $scope.resetView();
                $scope.getViewByClass('classReviewSubscription');
                break;
            case 4:
                $scope.step = 5;
                //$scope.resetView();
                $scope.getViewByClass('classSubscriptionComplete');
                break;
            default :
                return view1();
        }
    }
    $scope.setTpl = function (templateUrl) {
        $scope.templateUrl = templateUrl;
    }
    $scope.submitLogin = function () {
        var msg = messageService.setAlert('Hi User');
        console.log(msg);
        $rootScope.$broadcast('userChanged', msg);
    }
    $scope.submitRegister = function () {
        var msg = messageService.setAlert('Hi User');
        console.log(msg);
        $rootScope.$broadcast('userChanged', msg);
    }

    $scope.validateEmail = function () {
        return "formLogin.username.$dirty && formLogin.username.$invalid";
    }

    $scope.validatePassword = function () {
        return "formLogin.password.$dirty && formLogin.password.$invalid";
    }

})