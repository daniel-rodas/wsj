<header class="header row">

    <div class="row">
        <a class="col-md-3" href="/">
            <div id="brand" class="">WSJ</div>
        </a>
        <a class="col-md-6" href="<?php // the section link goes here ?>">
            <h3 class="wsj-section text-center"> <?= isset($section) ? $section : ''; ?></h3>
        </a>

        <div class="col-md-3">
            <!-- top_navbar_lbMenu -->
            <?= isset($navigation) ? $navigation : ''; ?>
        </div>
    </div>
</header>


