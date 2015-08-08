<div class="panel-heading">
    <h2>Subscription</h2>
</div>

<br>
<div  style="padding: 1.634rem"  class="panel-body">
    <?= View::forge()->render('_includes/message'); ?>


    <section class="delivery-address col-md-4 col-lg-4">
        <?php if ($user): ?>

            <p>
                <strong>Address:</strong>
                <?php echo (isset($user->delivery_address) ? $user->delivery_address : 'Please update Delivery Address'); ?></p>
            <p>
                <strong>Line 2:</strong>
                <?php echo (isset($user->delivery_address_2) ? $user->delivery_address_2 : 'Please update Line 2'); ?></p>
            <p>
                <strong>City:</strong>
                <?php echo (isset($user->delivery_city) ? $user->delivery_city : 'Please update City'); ?></p>
            <p>
                <strong>State:</strong>
                <?php echo (isset($user->delivery_state) ? $user->delivery_state : 'Please update State'); ?></p>

            <p>
                <strong>Zip Code:</strong>
                <?php echo (isset($user->delivery_zip_code) ? $user->delivery_zip_code : 'Please update Zip Code'); ?></p>



            <?php echo Html::anchor('backend/account/subscription/'.$user->id, 'Edit'); ?>



        <?php else: ?>
            <p>No user.</p>

        <?php endif; ?>
    </section>
    <section class="delivery-calendar col-md-8 col-lg-8">


        <style>
            .full button span {
                background-color: limegreen;
                border-radius: 32px;
                color: black;
            }
            .partially button span {
                background-color: orange;
                border-radius: 32px;
                color: black;
            }
        </style>
        <div ng-controller="DeliveryOptionsController">
            <h4>Choose Date to Stop  Delivery</h4>
            <pre><em>{{dt | date:'fullDate' }}</em></pre>

            <div style="margin-bottom: 0; display:inline-block; min-height:290px;">
                <datepicker style="margin-bottom: 0;" ng-model="dt" min-date="minDate" show-weeks="true" class="well well-sm" custom-class="getDayClass(date, mode)"></datepicker>
            </div>

            <hr />
            <button type="button" class="btn btn-sm btn-info" ng-click="today()">Today</button>
            <button type="button" class="btn btn-sm btn-default" ng-click="dt = '2009-08-24'">2009-08-24</button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="clear()">Clear</button>
            <button type="button" class="btn btn-sm btn-default" ng-click="toggleMin()" tooltip="After today restriction">Min date</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="saveDelivery()" tooltip="Stop Delivery">Save</button>
        </div>
    </section>

</div>