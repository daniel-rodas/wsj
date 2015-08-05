<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Description', 'description', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('description', Input::post('description', isset($balance) ? $balance->description : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Description')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Debit', 'debit', array('class'=>'control-label')); ?>

				<?php echo Form::input('debit', Input::post('debit', isset($balance) ? $balance->debit : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Debit')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Credit', 'credit', array('class'=>'control-label')); ?>

				<?php echo Form::input('credit', Input::post('credit', isset($balance) ? $balance->credit : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Credit')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Balance', 'balance', array('class'=>'control-label')); ?>

				<?php echo Form::input('balance', Input::post('balance', isset($balance) ? $balance->balance : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Balance')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>