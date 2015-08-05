<script type="text/ng-template" id="login.html"  class="panel">


    <?= \Form::open(array('action' => 'user/login', 'class' => 'form-signin', 'ng-class' => 'class')); ?>
    <h2 class="form-signin-heading">Please Sign In</h2>
    <div class="form-group">
        <?= Form::label('Email Address', 'username', array('class'=>'control-label')); ?>
        <input type="text" class="form-control" name="username" ng-model="username" placeholder="<?= __('user.model.username'); ?>" autofocus=""  />
    </div>

    <div class="form-group">
        <?= Form::label('Password', 'password', array('class'=>'control-label')); ?>
        <input type="password" ng-model="password" class="form-control" name="password" placeholder="<?= __('user.model.password'); ?>" required />
    </div>
    <p class="text-center">
        <button  type="submit" class="btn btn-primary btn-lg" > Login </button>
    </p>
    <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" />
    <?= \Form::close(); ?>
    <a ng-click="setTpl('recover.html')">Trouble signing in? Click here to reset your password.</a>

</script>

