angular
    .module('app.authentication')
    .controller('AuthenticationController', function ( $rootScope, MessageService, SubscriptionService) {

       //this.templateUrl = "register.html";
        this.setTemplate = function (templateUrl) {

            this.templateUrl = templateUrl;
        };


        this.step = 1;
        //this.$on('UserOptionChangeEvent', function (event, message) {
        //    this.subscription = message;
        //});

        this.checkboxModel = {
            value1: true,
            value2: 'YES'
        };

        this.nextButton = "Continue";
        this.class = "";

        this.resetView = function () {
            this.classBasicInfo = "hidden-xs hidden-sm hidden-md hidden-lg ";
            this.classDeliveryAddress = "hidden-xs hidden-sm hidden-md hidden-lg ";
            this.classBillingAddress = "hidden-xs hidden-sm hidden-md hidden-lg ";
            this.classReviewSubscription = "hidden-xs hidden-sm hidden-md hidden-lg ";
            this.classSubscriptionComplete = "hidden-xs hidden-sm hidden-md hidden-lg ";
        };

        this.getViewByClass = function (classString) {
            this[classString] = "visible-xs visible-sm visible-md visible-lg ";
        };

        this.resetView();
        this.getViewByClass('classBasicInfo');

        SubscriptionService.setEnding(4);
        this.back = function () {
            //// If at beginning do not go decrement step
            //if (this.step < SubscriptionService.getBeginning() + 2) {
            //    this.step = 1;
            //    this.resetView();
            //    this.getViewByClass('classBasicInfo');
            //}
            //if (this.step != SubscriptionService.getBeginning()) {
            //    this.step = this.step - 2;
            //
            //    this.changeContinue(this.step);
            //}
        };
        this.skip = function () {
            // If at ending do not go increment step
            //if (this.step != SubscriptionService.getEnding()) {
            //    this.changeContinue();
            //}
        };
        this.changeContinue = function () {
            var view1 = function () {
                if (this.subscription != 'digital') {
                    // Show Delivery address
                    this.step = 2;
                    this.resetView();
                    this.getViewByClass('classDeliveryAddress');
                }
                else {
                    // Subscription is Digital!
                    // Skip Step 2
                    this.step = 3;
                    this.resetView();
                    this.getViewByClass('classBillingAddress');
                }
            };

            // return view()
            switch (this.step) {
                case 1:
                    // Basic info
                    return view1();
                    break;
                case 2:
                    //code block
                    // show Billing Fieldset
                    this.step = 3;
                    this.resetView();
                    this.getViewByClass('classBillingAddress');

                    break;

                case 3:
                    //code block
                    this.step = 4;
                    this.nextButton = "Confirm";
                    this.resetView();
                    this.getViewByClass('classReviewSubscription');
                    break;
                case 4:
                    this.step = 5;
                    //this.resetView();
                    this.getViewByClass('classSubscriptionComplete');
                    break;
                default :
                    return view1();
            }
        }

        this.submitLogin = function () {
            var msg = MessageService.setAlert('Hi User');
            console.log(msg);
            $rootScope.$broadcast('userChanged', msg);
        }
        this.submitRegister = function () {
            var msg = MessageService.setAlert('Hi User');
            console.log(msg);
            $rootScope.$broadcast('userChanged', msg);
        }

        this.validateEmail = function () {
            return "formLogin.username.$dirty && formLogin.username.$invalid";
        }

        this.validatePassword = function () {
            return "formLogin.password.$dirty && formLogin.password.$invalid";
        }

    });
