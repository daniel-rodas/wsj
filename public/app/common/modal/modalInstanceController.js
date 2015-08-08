angular
    .module('app.core')
    .controller('ModalInstanceController', function ($scope, $modalInstance, categories, subCategories, $http) {
// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.
    $scope.letterLimitHeadline = 50;
    $scope.letterLimit = 140;
    $scope.subCategories = subCategories;
    $scope.categories = categories;
    $scope.selected = {
        item: $scope.categories[0]
    };

    $scope.ok = function () {
        $modalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.getSource = function (galleryItem) {

        for (var key in galleryItem) {

            if (galleryItem[key].asset.uri + galleryItem[key].asset.name) {
                return galleryItem[key].asset.uri + galleryItem[key].asset.name;
            }
            else {
                return false;
            }
        }
    };

    $scope.getNavSubCategories = function (slug) {
        var uri = '/blog/rest/navigation/navSubCategories.json?slugType=category&slug=' + slug;
        console.log(uri);
        $http.get(uri).success(function (subCategories) {
            $scope.subCategories = subCategories;
        });
    };
})