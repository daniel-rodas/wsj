<?php if(empty($related_articles)): ?>
<!--    <p>--><?//= __('frontend.post.empty'); ?><!--</p>-->
    <div class="advertisement blog-post-related ">
        <p>Advertisement</p>
    </div>
<?php else: ?>
    <div class=" blog-post-related">
    <h3>Related Stories</h3>
    <?php foreach($related_articles as $post): ?>
        <article  id="post-related-<?php echo $post->id; ?>" >
            <small>
                <a href="<?= \Router::get('show_post_category', array('category' => $post->category->slug)); ?>"><?= $post->category->name; ?></a>

            </small>
            <a href="<?= \Router::get('show_post', array('segment' => $post->slug)); ?>" >

                <h2 class=""><?= \Str::truncate($post->name, \Config::get('application.truncate', 50)); ?></h2>
            </a>
        </article>


    <?php endforeach; ?>
    </div>
<?php endif; ?>