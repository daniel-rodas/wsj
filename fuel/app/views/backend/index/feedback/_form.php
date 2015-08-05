<?php echo Form::open(array( "class"=>"form-horizontal"), $hidden = array('user_id' => $user_id)); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Feedback', 'feedback', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('feedback', Input::post('feedback', isset($feedback) ? $feedback->feedback : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Feedback')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>