// Core Module
//angular.module('app', ['ui.router', 'ngAnimate','ui.bootstrap','app.common','app.subscription','app.authentication','app.blog','app.deliveryOptions','app.media','app.whatsNews','app.ticker','app.validation' ]);
//angular.module('app.main', ['ui.router', 'ng.animate', 'ui.bootstrap', 'app.common']);
angular.module('app.main', [ 'ui.router', 'ui.bootstrap', 'app.common']);
angular.module('app.common', ['app.authentication']);
angular.module('app.subscription', []);
angular.module('app.authentication', [ 'app.delivery.options', 'app.subscription']);
//angular.module('app.blog', []);
angular.module('app.delivery.options', []);
//angular.module('app.media', []);
//angular.module('app.whatsNews', []);
//angular.module('app.ticker', []);
//angular.module('app.validation', []);




