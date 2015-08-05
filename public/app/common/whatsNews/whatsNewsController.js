.controller('whatsNewsCtrl', function ($scope) {
    $scope.class = "hidden-xs hidden-sm ";
    $scope.changeClass = function () {
        if ($scope.class === "") {
            $scope.class = "hidden-xs hidden-sm ";
        }
        else {
            $scope.class = "";
        }
    }
})