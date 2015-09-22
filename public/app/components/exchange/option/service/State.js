angular
    .module('app.exchange.option.service')
    .factory('OptionStateService', function OptionStateService (NewOptionStateService) {

        var currentState = NewOptionStateService(this);

        return {
            trade : trade,
            start : start
        };

        function trade(state) {
            currentState = state;
            currentState.go();
        };

        function start() {
            currentState.go();
        };

    });