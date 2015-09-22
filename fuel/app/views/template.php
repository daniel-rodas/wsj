<!DOCTYPE html>
<html ng-app="app.main" lang="en">
<head>
    <script src="//use.typekit.net/cvd1ish.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!--    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">-->
<!--    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">-->
<!--    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">-->
<!--    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">-->
<!--    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">-->
<!--    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">-->
<!--    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">-->
<!--    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">-->
<!--    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">-->
<!--    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">-->
<!--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">-->
<!--    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">-->
<!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap core CSS -->
    <?= Asset::css(
        [
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css',
            'animations.css',
            'styles.css'
        ] ); ?>

</head>
<body>
<div id="wrapper" class="container-fluid">
    <?= View::forge()->render('_includes/message'); ?>
    <?= (isset($header) ? $header : '' ); ?>
    <?= (isset($content) ? $content : '' ); ?>
    <?php echo Fuel::VERSION; ?>
</div>    <!-- End /#wrapper .container-fluid   -->

<!--    Add path to AngularJS app-->
<?= Asset::add_path('app/', 'ngApp', ['js','html']); ?>
<?//= Asset::add_path('app/components/exchange/', 'ExApp', ['js','html']); ?>

<!--  JS Libs  -->
<?= Asset::js([
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-route.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-animate.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.3/ui-bootstrap-tpls.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.15/angular-ui-router.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/angular-css/1.0.7/angular-css.min.js',
    Asset::get_file('app.module.js', 'ngApp'),
    Asset::get_file('common/header/navigationController.js', 'ngApp'),
    Asset::get_file('common/message/messageController.js', 'ngApp'),
    Asset::get_file('common/message/messageService.js', 'ngApp'),
    Asset::get_file('components/modal/modalInstanceController.js', 'ngApp'),
    Asset::get_file('components/authentication/authenticationController.js', 'ngApp'),
    Asset::get_file('components/subscription/subscriptionService.js', 'ngApp'),
    Asset::get_file('components/deliveryOptions/deliveryOptionsController.js', 'ngApp'),
    Asset::get_file('components/whatsNews/whatsNewsController.js', 'ngApp'),
    // Exchange App
    Asset::get_file('components/exchange/exchange.module.js', 'ngApp'),
    Asset::get_file('components/exchange/option/controller/Category.js', 'ngApp'),
    Asset::get_file('components/exchange/option/controller/Timeframe.js', 'ngApp'),
    Asset::get_file('components/exchange/option/controller/Quantity.js', 'ngApp'),
    Asset::get_file('components/exchange/option/controller/Create.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/State.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/state/Buy.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/state/Execute.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/state/New.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/state/Sell.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/OptionCommandState.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/Price.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/Category.js', 'ngApp'),
    Asset::get_file('components/exchange/option/service/ExpirationDate.js', 'ngApp'),

]); ?>
</body>
</html>