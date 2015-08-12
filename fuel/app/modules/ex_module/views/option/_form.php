<!-- Need to set coin_id in order to validate form -->
<?php echo Form::open(array("class"=>"form-horizontal"), $hidden = array('coin_id' =>  isset($option) ? $option->coin_id : '' ) ); ?>

	<fieldset>

        <div class="form-group">
            <?php echo Form::label('Expiration date', 'expiration_date', array('class'=>'control-label')); ?>

            <?php echo Form::input('expiration_date', Input::post('expiration_date', isset($option) ? $option->expiration_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Expiration date')); ?>

        </div>
		<div class="form-group">
			<?php echo Form::label('Strike', 'strike', array('class'=>'control-label')); ?>

				<?php echo Form::input('strike', Input::post('strike', isset($option) ? $option->strike : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Strike')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Coin', 'coin_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('coin_name', Input::post('coin_name', isset($option) ? $option->coins->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Coin')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Quantity', 'quantity', array('class'=>'control-label')); ?>

				<?php echo Form::input('quantity', Input::post('quantity', isset($option) ? $option->quantity : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Quantity')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Purchase', 'price', array('class'=>'control-label')); ?>

				<?php echo Form::input('price', Input::post('price', isset($option) ? $option->price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Purchase')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Category', 'category', array('class'=>'control-label')); ?>

				<?php echo Form::input('category', Input::post('category', isset($option) ? $option->category : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Category')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>