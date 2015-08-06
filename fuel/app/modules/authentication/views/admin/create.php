
<?= \Form::open(array('action' => 'user/auth/admincreate','class' => 'form-signin', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Add an Author</h2>
    <div class="form-group">
        <?php echo Form::label('First Name', 'first_name', array('class'=>'control-label')); ?>
        <?php echo Form::input('first_name', Input::post('first_name', isset($user) ? $user->first_name : ''), array('type' => 'text', 'class' => 'col-md-4 form-control', 'placeholder'=>'First Name')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('Last Name', 'last_name', array('class'=>'control-label')); ?>
        <?php echo Form::input('last_name', Input::post('last_name', isset($user) ? $user->last_name : ''), array('type' => 'text', 'class' => 'col-md-4 form-control', 'placeholder'=>'Last Name')); ?>
    </div>
<div class="form-group">
    <?php echo Form::label('Email Address', 'email', array('class'=>'control-label')); ?>
    <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email address')); ?>
</div>
    <p class="text-center"> <input type="submit" class="btn btn-default btn-lg" value="Add User" /></p>

<?= \Form::close(); ?>


