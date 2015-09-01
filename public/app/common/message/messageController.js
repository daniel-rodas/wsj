angular
    .module('app.common')
    .controller('MessageController', function ( $rootScope, MessageService) {
        this.alerts = [];
        //this.messageService = MessageService;
        //this.messageService.setAlert('Help Me Message Service!');

        this.addAlert = function () {

            this.alerts.push({msg: 'Another alert!'});
        };

        this.closeAlert = function (index) {
            this.alerts.splice(index, 1);
        };

        // TODO say what
        //$on('userChanged', function (event, message) {
        //    console.log(event);
        //
        //    this.alerts = [
        //        {type: 'info', msg: 'Oh snap! Something different is happening again.'},
        //        {type: 'warning', msg: message}
        //    ];
        //});
    });