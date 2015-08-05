.directive('ngUnique', function ($http) {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            elem.on('blur', function (evt) {
                scope.$apply(function () {
                    $http({
                        method: 'POST',
                        url: 'http://wsj.rodasnet.com/user/rest/is_unique',
                        data: {
                            username: elem.val()
                        }
                    }).success(function (data, status, headers, config) {
                        //ctrl.$setValidity('unique', data.unique);
                        console.log('Data:');
                        console.log(data);
                        console.log('Status:');
                        console.log(status);
                    });
                });
            });
        }
    };
})