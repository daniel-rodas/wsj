angular
    .module('app.exchange.option.service.state')
    .factory('ExecuteOptionStateService', function ExecuteOptionStateService (optionState) {

        this.state = optionState;

        return {
            go:go
        };

        function go () {
            // TODO implement execute
        }
    });