

<?php if (isset($header)): ?>
    <?php echo $header; ?>
<?php endif; ?>
    <div class="row">
        <section class="col-md-3">

        </section>
        <section class="col-md-2">

            <ul class="nav nav-pills nav-stacked">
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/basic') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/basic', 'Basic Information'); ?></li>
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/subscription') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/subscription', 'Subscription'); ?></li>
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/password') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/password', 'Manage Password'); ?></li>
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/graphs') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/graphs', 'Graphs'); ?></li>
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/save') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/save', 'Saved Articles'); ?></li>
                <li <?php echo  (Uri::current() === 'http://wsj.rodasnet.com/backend/account/index/social') ?  'class="active"' : '' ; ?>>

                    <?php echo Html::anchor('backend/account/index/social', 'Social Networks'); ?></li>
            </ul>
        </section>
        <section class="col-md-4">
            <div class="panel panel-default">



                        <?=  isset($content) ? $content : '' ; ?>


                <!-- Endof #myTabContent   #home  -->
            </div><!-- Endof #myTabContent   .tab-content  -->
        </section>


    </div>



