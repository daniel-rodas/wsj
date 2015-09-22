
angular.module('app.exchange.coin.service', []);
angular.module('app.exchange.coin.controller', []);
angular.module('app.exchange.coin', ['app.exchange.coin.service, app.exchange.coin.controller']);

angular.module('app.exchange.option.service', []);
angular.module('app.exchange.option.controller', []);
angular.module('app.exchange.option', ['app.exchange.option.service','app.exchange.option.controller, app.exchange.coin']);
angular.module('app.exchange', ['app.exchange.option']);





