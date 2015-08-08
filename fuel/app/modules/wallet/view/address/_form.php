<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('address', Input::post('address', isset($address) ? $address->address : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Address')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Coin', 'coin', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('coin', Input::post('coin', isset($address) ? $address->coin : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Coin')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>