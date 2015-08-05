

            <div class="header front-page row">
                <a href="/"><div id="brand-wsj" >Wall Street Journal</div></a>
                <!-- top_navbar_lbMenu -->
                <?php if (isset($navigation)): ?>
                    <?php echo $navigation; ?>
                <?php endif; ?>
            </div><!-- End /.row-->



        <div class="row">
            <div ng-controller="whatsNewsCtrl" id="whats-news-column" class=" col-md-2 col-lg-2  " >
                <h3 ng-click="changeClass()" class="h3">What's News </h3>
                <section ng-class="class">


                    <p>The Geneva public prosecutor’s office has begun a search of the offices of U.K. banking giant
                        HSBC’s Swiss unit as part of a probe into alleged money-laundering activities.</p>
                </section>

            </div>
            <div class="col-sm-9 col-md-8 col-lg-6 " >
                <?php if (isset($content)): ?>
                        <?php echo $content; ?>
                    <?php endif; ?>
                    <?php if (isset($secondary_story)): ?>
                        <?php echo $secondary_story; ?>
                    <?php endif; ?>

            </div>
            <div class="col-sm-3 col-md-2 col-lg-4 " >
                <?php if (isset($more_news)): ?>
                    <?php echo $more_news; ?>
                <?php endif; ?>

            </div>
        </div>
        <!-- End. Row -->

