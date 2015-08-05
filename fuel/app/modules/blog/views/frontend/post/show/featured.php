<article class="post featured-story">

    <a href="<?= \Router::get('show_post', array('segment' => $post->slug)); ?>">
        <h1><?php echo $post->name; ?></h1>
        <img class="img-responsive" src="<?php echo $featured_image; ?>" alt=""/>

        <p>
            <?php echo \Str::truncate($post->content, 400, ' <span class="primary-text">&hellip;continue reading</span>'); ?>
        </p>
    </a>

</article>

