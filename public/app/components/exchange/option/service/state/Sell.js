angular
    .module('app.exchange.option.service.state')
    .factory('SellOptionStateService', function SellOptionStateService (optionState, BuyOptionStateService) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {

            state.trade( BuyOptionStateService(state) );
        }
    });