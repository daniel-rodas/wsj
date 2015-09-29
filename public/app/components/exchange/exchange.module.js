
angular.module('app.exchange.symbol.controller', []);
angular.module('app.exchange.symbol.service', []);
angular.module('app.exchange.symbol', ['app.exchange.symbol.service', 'app.exchange.symbol.controller']);

angular.module('app.exchange.option.service', []);
angular.module('app.exchange.option.service.state', []);
angular.module('app.exchange.option.controller', []);
angular.module('app.exchange.option',
    ['app.exchange.option.service','app.exchange.option.controller', 'app.exchange.option.service.state', 'app.exchange.symbol']);

angular.module('app.exchange', ['app.exchange.option']);






