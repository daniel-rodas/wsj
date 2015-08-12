<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($transaction) ? $transaction->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Option id', 'option_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('option_id', Input::post('option_id', isset($transaction) ? $transaction->option_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Option id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Action', 'action', array('class'=>'control-label')); ?>

				<?php echo Form::input('action', Input::post('action', isset($transaction) ? $transaction->action : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Action')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Purchase', 'purchase', array('class'=>'control-label')); ?>

				<?php echo Form::input('purchase', Input::post('purchase', isset($transaction) ? $transaction->purchase : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Purchase')); ?>

		</div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>