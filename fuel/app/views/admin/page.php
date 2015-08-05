<?= isset($header) ? $header : null; ?>

<div class="row">
    <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12">
        <div class="row">

            <div class="col-gl-6 col-md-6 col-xs-6 col-sm-6">

                <?= isset($authors) ? $authors : null; ?>
                <?= isset($users) ? $users : null; ?>
            </div>

            <div class="col-gl-6 col-md-6 col-xs-6 col-sm-6">
                <?= isset($category) ? $category:null; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <?= View::forge()->render('_includes/message'); ?>

        <?= isset($content) ? $content : null; ?>

        <?= isset($create_article) ? $create_article : null; ?>

    </div>

    <div class="col-gl-2 col-md-2 col-xs-12 col-sm-12">
        <?= Request::forge('blog/backend/post/sidebar', false)->execute(); ?>

    </div>
</div>

<p>Backend Layout</p>