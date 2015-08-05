<?php echo Form::open(array("class" => "form-horizontal")); ?>

    <fieldset>
        <div class="form-group">
            <?php echo Form::label('First', 'firstname', array('class' => 'control-label')); ?>
            <?php echo Form::input('firstname', Input::post('firstname', isset($user->firstname) ? $user->firstname : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'First')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Last', 'lastname', array('class' => 'control-label')); ?>
            <?php echo Form::input('lastname', Input::post('lastname', isset($user->lastname) ? $user->lastname : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Last')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Email', 'email', array('class' => 'control-label')); ?>
            <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Market Label Ex. BTC-user')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>        </div>
    </fieldset>
<?php echo Form::close(); ?>