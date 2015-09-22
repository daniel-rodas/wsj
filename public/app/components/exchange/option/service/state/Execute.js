angular
    .module('app.exchange.option.service')
    .factory('ExecuteOptionStateService', function ExecuteOptionStateService (optionState) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {
            // TODO implement execute
        }
    });