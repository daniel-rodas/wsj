<div class="row">
    <div ng-init="setTpl('<?= ( isset($ng_view) ? $ng_view : null ) . '.html' ?>')" ng-controller="AuthenticationController"
         class=" col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

        <?= View::forge()->render('_includes/angularjs_message'); ?>

        <?php if (isset($content)): ?>
            <?php
            foreach($content as $form)
            {
                echo $form;
            }

            ?>
            <div ng-include="templateUrl"></div>
        <?php endif; ?>

    </div>

</div>