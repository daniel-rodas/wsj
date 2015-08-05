<?php echo Form::open(array( "class"=>"form-horizontal"), $hidden = array('user_id' => $user_id)); ?>

	<fieldset>
<!--        --><?php //if($addresses): ?>
<!--        --><?php //foreach ($addresses as $item) : ?>
<!--        <div class="radio">-->
<!--            <label>-->
<!--                --><?php //echo Form::radio('address_id', $item->address_id, true); ?>
<!--                --><?php //echo $item->addresses->address; ?>
<!--            </label>-->
<!--        </div>-->
<!--        --><?php //endforeach; ?>
<!--        --><?php //else: ?>
<!--            <p>GryFX Wallet is not setup.</p>-->
<!---->
<!--        --><?php //endif; ?>

		<div class="form-group">
			<?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

				<?php echo Form::input('address', Input::post('address', isset($sendcoin) ? $sendcoin->address : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Address')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Quantity', 'quantity', array('class'=>'control-label')); ?>

				<?php echo Form::input('quantity', Input::post('quantity', isset($sendcoin) ? $sendcoin->quantity : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Quantity')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>