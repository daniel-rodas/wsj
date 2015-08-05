<article class="post">
    <div class="page-header">
    <h1><?= $post->name; ?></h1>
    <p>
    	<small>
			<?= __('by'); ?> <a href="<?= \Router::get('show_post_author', array('author' => $post->user->username)); ?>">
                <?= $post->user->username; ?></a> <?= __('on'); ?> <em><?= date('d/m/Y', $post->created_at); ?></em>
		 </small>
	 </p>
    </div>
    <?=  ( $snippet == true) ?   \Str::truncate(\Markdown::parse($post->content), \Config::get('application.truncate', 400)) :  \Markdown::parse($post->content); ?>

</article>