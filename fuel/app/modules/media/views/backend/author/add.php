<p><a href="<?= \Router::get('admin'); ?>"><?= __('backend.back-to-category'); ?></a></p>
<!--<pre>-->
<!---->
<!--    --><?//= print_r($form); ?>
<!--</pre>-->
<?= \Form::open(array('class'   => '')); ?>
    <div class="row">
        <div class="col-md-4">
		    <?= $form->field('firstname')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-4">
		    <?= $form->field('lastname')->set_attribute(array('class' => 'form-control')) ?>
        </div>
        <div class="col-md-4">
		    <?= $form->field('email')->set_attribute(array('class' => 'form-control')) ?>
        </div>
    </div>
    <?= $form->field('add') ?>
<?= \Form::close(); ?>