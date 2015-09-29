angular
    .module('app.exchange.option.service.state')
    .factory('NewOptionStateService', function NewOptionStateService (optionState, SellOptionStateService) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {

            state.trade( SellOptionStateService(state) );
        }
    });