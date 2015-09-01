angular
    .module('app.common')
    .factory('ControlService', function () {

        return {

            back: function () {
                // If at beginning do not go decrement step
                if (this.step < SubscriptionService.getBeginning() + 2) {
                    this.step = 1;
                    this.resetView();
                    this.getViewByClass('classBasicInfo');
                }
                if (this.step != SubscriptionService.getBeginning()) {
                    this.step = this.step - 2;

                    this.changeContinue(this.step);
                }
            },
            skip: function () {
                // If at ending do not go increment step
                if (this.step != SubscriptionService.getEnding()) {
                    this.changeContinue();
                }
            },
            changeContinue: function () {



            },
            getView: function () {

            }
        };
    });