<article class="post">
    <div class="page-header">
    <h1>Name: <?= $post->name; ?></h1>
    <h2>Created At: <?= $post->created_at; ?></h2>
    <h2>Id: <?= $post->id; ?></h2>
    <h2>User Id: <?= $post->user_id; ?></h2>
    <h2>Category Id: <?= $post->category_id; ?></h2>

    <p>
    	<small>
<!-- \Router::get('show_post_author', array('author' => $post->author->id)); -->
<!-- Post Date -->
		 </small>
	 </p>
    </div>

    <graph></graph>
    <h3>Content: </h3>
        <?=   \Str::truncate( \Markdown::parse($post->content), \Config::get('application.truncate' , 150)) ; ?>
</article>
