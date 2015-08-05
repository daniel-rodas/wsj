<div class="page-header">
    <p class="lead"><?= $category->name; ?></p>
</div>
<?//= \Theme::instance()->view('')->set(, null, false); ?>
<?php echo render('frontend/post/_includes/list', array('posts' => $posts, 'pagination' => $pagination) ); ?>