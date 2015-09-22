angular
    .module('app.exchange.option.service')
    .factory('NewOptionStateService', function NewOptionStateService (optionState, SellOptionStateService) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {

            state.trade( SellOptionStateService(state) );
        }
    });