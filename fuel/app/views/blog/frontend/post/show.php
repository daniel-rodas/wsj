<article class="post">
    <div class="page-header">
        <h1><?= $post->name; ?></h1>
        <p>
            <small>
                <?= __('by'); ?> <a href="<?= \Router::get('show_post_author', array('author' => $post->author->id)); ?>">
                    <?= $post->author->first_name .' '. $post->author->first_name; ?></a> <?= __('on'); ?> <em><?= date('d/m/Y', $post->created_at); ?></em>
            </small>
        </p>
    </div>

    <graph></graph>

    <?= \Markdown::parse($post->content); ?>
</article>
