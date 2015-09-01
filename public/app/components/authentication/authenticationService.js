angular
    .module('app.authentication')
    .factory('AuthenticationService', function () {
        var username;
        var password;
        return {

            login: function ( username, password ) {
                console.log(username);
                return username;
            }
        };
    });