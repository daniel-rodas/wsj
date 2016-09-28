
<div style="border: dashed 10px rgba(32,32,56,0.3)" class="stripes-please row">

    <div   class=" col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

        <?= View::forge()->render('_includes/angularjs_message'); ?>

        <?php if (isset($authentication_form)): ?>
            <?php
            foreach($authentication_form as $form)
            {
                echo $form;
            }

            echo '<div class="user-auth-background" ng-include="templateUrl"></div>';
            ?>

        <?php endif; ?>



    </div>

</div>