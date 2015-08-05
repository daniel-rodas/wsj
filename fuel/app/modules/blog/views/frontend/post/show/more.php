<?php if(empty($posts)): ?>
	<p><?= __('frontend.post.empty'); ?></p>
<?php else: ?>
	<?php foreach($posts as $post): ?>
		<article id="post-<?php echo $post->id; ?>" class="post-preview">
		    <a href="<?= \Router::get('show_post', array('segment' => $post->slug)); ?>" >
                <h2><?= $post->name; ?></h2>
                <p><?= \Str::truncate(\Markdown::parse($post->content), \Config::get('application.truncate', 200)); ?></p>
            </a>
            <small>
                <a href="<?= \Router::get('show_post_category', array('category' => $post->category->slug)); ?>"><?= $post->category->name; ?></a>,
                <?= __('by'); ?> <a href="<?= \Router::get('show_post_author', array('author' => $post->user->first_name)); ?>"><?= $post->user->first_name; ?></a>
                <em><?= date('d/m/Y', $post->created_at); ?></em>
            </small>
		</article>
	<?php endforeach; ?>
<?php endif; ?>

