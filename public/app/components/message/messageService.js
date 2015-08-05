.factory('messageService', function () {
    var message;
    return {

        setAlert: function (message) {
            console.log(message);
            return message;
        }
    };
})