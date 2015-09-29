angular
    .module('app.exchange.option.service')
    .factory('CategoryService', function CategoryService () {
        var value;
        return {
            setCategory : setCategory
        };

        function setCategory(val) {
            value = val;
            alert(value);
            console.log(value);
        }
    });