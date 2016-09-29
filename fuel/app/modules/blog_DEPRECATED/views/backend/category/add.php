<p><a href="<?= \Router::get('admin'); ?>"><?= __('backend.back-to-category'); ?></a></p>
<!--<pre>-->
<!---->
<!--    --><?//= print_r($form); ?>
<!--</pre>-->
<?= \Form::open(array('class'   => '')); ?>
    <div class="row">
        <div class="col-md-4">
		    <?= $form->field('name')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-4">
		    <?= $form->field('slug')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-4">
		    <?= $form->field('parent_id')->set_attribute(array('class' => 'form-control')) ?>
        </div>
    </div>
    <?= $form->field('add') ?>
<?= \Form::close(); ?>