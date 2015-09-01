angular
    .module('app.common')
        .factory('MessageService', function () {
        var message;
        return {

            setAlert: function (message) {
                return message;
            }
            //,
            //addAlert: function (message) {
            //    console.log(message);
            //    return message;
            //},
            //closeAlert: function (message) {
            //    console.log(message);
            //    return message;
            //}
        };
});