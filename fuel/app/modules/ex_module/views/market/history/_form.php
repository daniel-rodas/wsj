<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Market', 'market', array('class'=>'control-label')); ?>

				<?php echo Form::input('market', Input::post('market', isset($market_history) ? $market_history->market : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Market')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Coin id', 'coin_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('coin_id', Input::post('coin_id', isset($market_history) ? $market_history->coin_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Coin id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Last price', 'last_price', array('class'=>'control-label')); ?>

				<?php echo Form::input('last_price', Input::post('last_price', isset($market_history) ? $market_history->last_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Last price')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Api url', 'api_url', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('api_url', Input::post('api_url', isset($market_history) ? $market_history->api_url : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Api url')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>