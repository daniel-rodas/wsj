<header class="header row">

    <div class="row">
        <a class="col-sm-3 col-md-3" href="/">
            <div id="brand" class="">WSJ</div>
        </a>
        <a class="col-sm-6 col-md-6" href="<?php // TODO the section link goes here ?>">
            <h3 class="wsj-section text-center"> <?= isset($section) ? $section : ''; ?></h3>
        </a>

        <div class="col-sm-3 col-md-3">
            <!-- top_navbar_lbMenu -->
            <?= isset($navigation) ? $navigation : ''; ?>
        </div>
    </div>
</header>


