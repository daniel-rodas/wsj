angular
    .module('app.common')
    .controller('NavigationController', function ( $http, $modal, $log) {

    // get main section categories, then populate top level navigation links
    $http.get('/blog/rest/navigation/navSectionCategories.json').success(function (categories) {
        this.categories = categories;
    });

    var path = window.location.pathname;
    path = path.slice(1, path.length);

    var uri = '/blog/rest/navigation/navSubCategories.json?slugType=post&slug=' + path;

    $http.get(uri).success(function (subCategories) {
        this.subCategories = subCategories;
    });

    this.open = function (size) {

        var modalInstance = $modal.open({
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                categories: function () {
                    return this.categories;
                },
                subCategories: function () {
                    return this.subCategories;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            this.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
});