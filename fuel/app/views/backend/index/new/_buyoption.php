<?php echo Form::open(array("action" => "backend/app/new", "class"=>"col-md-6", "id" => "new-option" ),
    $hidden = array('coin_id' => '', 'timeframe' => '', 'option' => '', 'quantity' => '', 'strike' => '', 'status' => 'New')); ?>
<?php echo Form::close(); ?>