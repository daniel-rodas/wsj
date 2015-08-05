.controller('controllerHeader', function ($scope, $http, $modal, $log) {

    // get main section categories, then populate top level navigation links
    $http.get('/blog/rest/navigation/navSectionCategories.json').success(function (categories) {
        $scope.categories = categories;
    });

    var path = window.location.pathname;
    path = path.slice(1, path.length);

    var uri = '/blog/rest/navigation/navSubCategories.json?slugType=post&slug=' + path;

    $http.get(uri).success(function (subCategories) {
        $scope.subCategories = subCategories;
    });

    $scope.open = function (size) {

        var modalInstance = $modal.open({
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                categories: function () {
                    return $scope.categories;
                },
                subCategories: function () {
                    return $scope.subCategories;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
})