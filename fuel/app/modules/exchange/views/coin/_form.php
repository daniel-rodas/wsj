<?php echo Form::open(array("class" => "form-horizontal", "enctype" => "multipart/form-data")); ?>

    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Name *', 'name', array('class' => 'control-label')); ?>
            <?php echo Form::input('name', Input::post('name', isset($coin) ? $coin->name : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Name')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Alt Tag', 'alt', array('class' => 'control-label')); ?>
            <?php echo Form::input('alt', Input::post('alt', isset($coin) ? $coin->alt : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Img alt tag (Optional), uses market tag by default')); ?>
        </div>
        <label class="control-label" for="api">API ( There can only be one for now... )</label>
        <div class="input-group">
            <span class="input-group-addon">
                <input name="api" type="radio" checked value="https://bittrex.com/api/v1.1/public/getticker">
            </span>
            <span disabled class="form-control"> https://bittrex.com/api/v1.1/public/getticker </span>
        </div>
        <!-- /input-group -->
        <div class="form-group">
            <?php echo Form::label('Market Tag *', 'market', array('class' => 'control-label')); ?>
            <?php echo Form::input('market', Input::post('market', isset($coin) ? $coin->market : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Market Label Ex. BTC-COIN')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Upload Img *', '', array('class' => 'control-label')); ?>

            <?php echo Form::input('file', Input::post('', isset($coin) ? $coin->file : ''), array('type' => 'file', 'class' => 'disabled col-md-4 form-control', 'placeholder' => 'Icon file name')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>        </div>
    </fieldset>
<?php echo Form::close(); ?>