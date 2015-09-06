angular
    .module('app.exchange')
    .factory('CategoryService', function () {
        var username;
        var password;
        return {

            login: function ( username, password ) {
                console.log(username);
                return username;
            }
        };
    });