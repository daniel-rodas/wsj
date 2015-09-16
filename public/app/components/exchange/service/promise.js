/**
 * Created by Rodas on 9/6/2015.
 */

angular.module('app.exchange.service')
    .service('promiseService', function($html){

        return {
            putOpenkeyval: function (key, value) {
                var putURL = 'http://api.openkeyval.org/store/';

                var params = {
                    'callback': 'JSON_CALLBACK'
                };
                params[key] = value;
                var putPromise = $http.jsonp(putURL, {
                    'params': params
                });
                return putPromise;
            },

            getOpenkeyval: function (key) {
                var getURL = 'http://api.openkeyval.org/';

                return $http.jsonp(getURL + key, {
                    'params': {
                        'callback': 'JSON_CALLBACK'
                    }
                }).then(
                    function (response) {
                        // In this case we'll dig out the value we actually want and use that to resolve the promise which .then()
                        // has created for us.
                        return response.data;
                    }
                );
            }
        };
    });