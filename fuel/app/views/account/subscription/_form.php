<?php echo Form::open(array("class" => "form-horizontal")); ?>

    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Delivery Address', 'address', array('class' => 'control-label')); ?>
            <?php echo Form::input('delivery_address', Input::post('delivery_address', isset($user->delivery_address) ? $user->delivery_address : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Delivery Address')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Line 2', 'address2', array('class' => 'control-label')); ?>
            <?php echo Form::input('delivery_address_2', Input::post('delivery_address_2', isset($user->delivery_address_2) ? $user->delivery_address_2 : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Line 2')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('City', 'city', array('class' => 'control-label')); ?>
            <?php echo Form::input('delivery_city', Input::post('delivery_city', isset($user->delivery_city) ? $user->delivery_city : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'City')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('State', 'state', array('class' => 'control-label')); ?>
            <?php echo Form::input('delivery_state', Input::post('delivery_state', isset($user->delivery_state) ? $user->delivery_state : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'State')); ?>
        </div>

        <div class="form-group">
            <?php echo Form::label('Zip Code', 'state', array('class' => 'control-label')); ?>
            <?php echo Form::input('delivery_zip_code', Input::post('deliver_zip_code', isset($user->delivery_zip_code) ? $user->delivery_zip_code : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'State')); ?>
        </div>



        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>        </div>
    </fieldset>
<?php echo Form::close(); ?>