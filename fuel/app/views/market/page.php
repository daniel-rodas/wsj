<div class="row">
    <header class="article-page  col-lg-12">
        <a href="/"><div id="brand-wsj" class="text-center">Wall Street Journal</div></a>
        <!-- _templates/top_navbar -->
        <?php if (isset($navigation)): ?>
            <?php echo $navigation; ?>
        <?php endif; ?>
    </header>
</div><!-- End /.row-->
<div class="row">
    <section class="col-md-1">
        <aside>
            <nav id="tools-share">
                <ul class="list-group">
                    <li class="list-group-item">Email</li>
                    <li class="list-group-item">FB Share</li>
                    <li class="list-group-item">Tweet</li>
                    <li class="list-group-item">Save</li>
                    <li class="list-group-item">More</li>
                </ul>
            </nav>
        </aside>

    </section>

    <section class="col-md-4">
        <?= View::forge()->render('_includes/session_flash'); ?>
        <?php if (isset($content)): ?>
            <?php echo $content; ?>
        <?php endif; ?>
    </section>
    <section class="col-md-4">
        <?php if (isset($sidebar)): ?>
            <?php echo $sidebar; ?>
        <?php endif; ?>
    </section>

</div>
    <p>Market Layout</p>


