// Core Module

angular.module('app.subscription.options', []);
angular.module('app.subscription', ['app.subscription.options']);
angular.module('app.authentication', [ 'app.subscription']);

//angular.module('app.blog', []);
//angular.module('app.media', []);
//angular.module('app.whatsNews', []);
//angular.module('app.ticker', []);
//angular.module('app.validation', []);

angular.module('app.common', ['app.authentication', 'app.exchange']);

angular.module('app.main', [ 'ui.router', 'ui.bootstrap', 'app.common']);



