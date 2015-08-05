
        <div class="row">
            <header class="front-page col-lg-12">
                <a href="/"><div id="brand-wsj" class="text-center">Wall Street Journal</div></a>
                <!-- top_navbar_lbMenu -->
                <?php if (isset($navigation)): ?>
                    <?php echo $navigation; ?>
                <?php endif; ?>
            </header>
        </div><!-- End /.row-->


        <div class="row">
            <div class="col-md-6 " >

                    <?php if (isset($content)): ?>
                        <?php echo $content; ?>
                    <?php endif; ?>

            </div>
            <div class="col-md-6 " >

                <?php if (isset($secondary_post)): ?>
                    <?php echo $secondary_post; ?>
                <?php endif; ?>

            </div>
        </div>
        <!-- End. Row -->
        <p>Front Page Layout</p>
