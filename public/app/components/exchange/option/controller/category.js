angular.module('app.exchange.option.controller')
    .controller('CategoryController', function ($scope, StateService) {
        this.state = StateService;
        //this.state.setCategory(this.radioModel);

        //$scope.$watch(
        //    function watchCategory(scope){
        //        // The "results" of watch expression.
        //        return(CC.this.radioModel);
        //    }
        //);
    });
