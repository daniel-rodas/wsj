<div class="row">
    <div ng-init="AC.setTemplate('<?= $ng_view . '.html' ?>')" ng-controller="AuthenticationController as AC"
         class=" col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <?= View::forge()->render('_includes/angularjs_message'); ?>
        <?= $facebook_login; ?>
        <?= $register; ?>
        <?= $login; ?>
        <?= $recover; ?>

        <div ng-include="AC.templateUrl"></div>
    </div>
</div>