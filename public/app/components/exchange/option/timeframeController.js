angular
    .module('app.exchange')
    .controller('TimeframeController', function () {
        this.radioModel = {
            '30m': false,
            '90m': true,
            '6h': false,
            '1d': false,
            '7d': false
        };
    });
