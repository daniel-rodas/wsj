<!--<p><a href="--><?//= \Router::get('admin'); ?><!--">--><?//= __('backend.back-to-post'); ?><!--</a></p>-->
<h3>Add New Article</h3>
<?= \Form::open(array('class'   => '')); ?>
    <div class="row">
        <div class="col-md-6">
		    <?= $form->field('name')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-3">
		    <?= $form->field('slug')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-3">
                <?= $form->field('category_id')->set_attribute(array('class' => 'form-control')) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
            <?= $form->field('user_id')->set_attribute(array('class' => 'form-control')) ?>
        </div>

        <div class="col-md-9">
            <?= $form->field('original_url')->set_attribute(array('class' => 'form-control')) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field('content')->set_attribute(array('class' => 'form-control')) ?>
        </div>

    </div>

    <?= $form->field('add') ?>
<?= \Form::close(); ?>