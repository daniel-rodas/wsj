<h4><?= __('categories'); ?></h4>
<div class="list-group">
    <?php foreach((array)$categories as $category): ?>
        <a href="<?= \Router::get('show_post_category', array('category' => $category->slug)); ?>" class="list-group-item">
        <a href="<?= \Request::forge('show_post_category', array('category' => $category->slug), false)->execute();  ?>" class="list-group-item">
            <span class="badge"><?= $category->post_count; ?></span>
            <?= $category->name; ?>
        </a>
    <?php endforeach; ?>
</div>