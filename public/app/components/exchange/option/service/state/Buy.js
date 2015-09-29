angular
    .module('app.exchange.option.service.state')
    .factory('BuyOptionStateService', function BuyOptionStateService (optionState, ExecuteOptionStateService) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {

            state.trade( ExecuteOptionStateService(state));
        }
    });