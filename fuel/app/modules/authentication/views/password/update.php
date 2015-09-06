
<?= \Form::open(array('action' => 'authentication/password/update', 'class' => 'form-signin form-reset-password')); ?>
	<h4 class="form-signin-heading">Reset your password</h4>
	<input type="password" class="form-control" name="password" placeholder="<?= __('user.model.password'); ?>">
	<input type="password" class="form-control" name="new_password" placeholder="<?= __('user.login.new_password'); ?>">
	<input type="password" class="form-control" name="confirm_password" placeholder="<?= __('user.login.confirm_password'); ?>">
	<button class="btn btn-lg btn-primary btn-block" type="submit"><?= __('user.login.reset'); ?></button>
<?= \Form::close(); ?>
	