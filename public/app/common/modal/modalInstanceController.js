angular
    .module('app.common')
    .controller('ModalInstanceController', function ( $modalInstance, categories, subCategories, $http) {
// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.
    this.letterLimitHeadline = 50;
    this.letterLimit = 140;
    this.subCategories = subCategories;
    this.categories = categories;
    this.selected = {
        item: this.categories[0]
    };

    this.ok = function () {
        $modalInstance.close(this.selected.item);
    };

    this.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    this.getSource = function (galleryItem) {

        for (var key in galleryItem) {

            if (galleryItem[key].asset.uri + galleryItem[key].asset.name) {
                return galleryItem[key].asset.uri + galleryItem[key].asset.name;
            }
            else {
                return false;
            }
        }
    };

    this.getNavSubCategories = function (slug) {
        var uri = '/blog/rest/navigation/navSubCategories.json?slugType=category&slug=' + slug;
        console.log(uri);
        $http.get(uri).success(function (subCategories) {
            this.subCategories = subCategories;
        });
    };
});