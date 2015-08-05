

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
        <section class="col-md-3">
            <h3>Thoughts on Gender Equality in Tech, Interrupted </h3>
            <p>Google Executive Chairman Eric Schmidt repeatedly interrupted US
                Chief Technology Officer Megan Smith at a panel on gender
                diversity in tech at the South by Southwest festival. </p>
            <p>6 Hours ago | DIGITS</p>
            <hr/>
            <h3>Good News for Women in Tech: Half of Fortune 10 CIOs are Women </h3>
            <p>Which companies are friendly to working women? A self-described "data geek" wants workers to weigh in.  </p>
            <p>03/12/15 | At Work</p>
            <hr/>
            <h3>The Companies That Work for Working Women  </h3>
            <p>Women make up 17.4% of the Fortune 500 CIOs, compared to 11.4% of chief financial officers and 4.8% of CEOs. </p>
            <p>01/14/15 | The CIO Report</p>
        </section>

    </div>
    <p>Account Layout</p>


