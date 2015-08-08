angular
    .module('ticker')
.controller("LineChartController", ["$scope", function ($scope) {
    //$scope.salesData = [
    //    {hour: 1,sales: 54},
    //    {hour: 2,sales: 66},
    //    {hour: 3,sales: 77},
    //    {hour: 4,sales: 70},
    //    {hour: 5,sales: 60},
    //    {hour: 6,sales: 63},
    //    {hour: 7,sales: 55},
    //    {hour: 8,sales: 47},
    //    {hour: 9,sales: 55},
    //    {hour: 10,sales: 30}
    //];

    $scope.NIKEData = [
        {hour: 9, points: 19500},
        {hour: 10, points: 19650},
        {hour: 11, points: 19500},
        {hour: 12, points: 19600},
        {hour: 1, points: 19700},
        {hour: 2, points: 19800}
    ];
}])