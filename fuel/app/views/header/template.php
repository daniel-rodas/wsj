<header class="header">

    <a href="/" id="brand">
        <span class="sr-only"><?= $brand ?></span>
    </a>

    <h3 class="wsj-section text-center">
        <a href="<?php // TODO the section link goes here ?>">
        <?= isset($section) ? $section : ''; ?></a>
    </h3>

    <!-- top_navbar_lbMenu -->
    <?= isset($navigation) ? $navigation : ''; ?>

</header>


