<!-- Need to set coin_id in order to validate form -->
<?php echo Form::open(array("class"=>"form-horizontal"), $hidden = array('coin_id' =>  isset($option) ? $option->coin_id : '' ) ); ?>

	<fieldset>

        <div class="form-group">
            <?php echo Form::label('Time Frame', 'time_frame', array('class'=>'control-label')); ?>

            <?php

            echo Form::select('time_frame',  '30m',
                [
                    '30m' => '30 Minutes',
                    '90m' => '90 Minutes',
                    '6h' => '6 Hours',
                    '1d' => '1 Day',
                ],
                ['class' => 'col-md-4 form-control',]
            );?>
        </div>

        <div class="form-group">
            <?php echo Form::label('Category', 'category', array('class'=>'control-label')); ?>

            <?php

            echo Form::select('category',  'Put',
                [
                    'Put' => 'Put',
                    'Call' => 'Call',
                    'Future' => 'Future',
                    'Short' => 'Short',
                ],
                ['class' => 'col-md-6 form-control',]
            );?>
        </div>

        <div class="form-group">
            <?php echo Form::label('Coin', 'coin_name', array('class'=>'control-label')); ?>

            <?php

            echo Form::select('coin_name',  'ApexCoin',
                [
                    'ApexCoin' => 'Apex Coin',
                    'CannabisCoin' => 'Cannabis Coin',
                    'Cannacoin' => 'Canna Coin',
                ],
                ['class' => 'col-md-6 form-control',]
            );?>
        </div>

		<div class="form-group">
			<?php echo Form::label('Quantity', 'quantity', array('class'=>'control-label')); ?>

				<?php echo Form::input('quantity', '', array('class' => 'col-md-4 form-control', 'placeholder'=>'Quantity')); ?>

		</div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>