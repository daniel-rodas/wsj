<script type="text/ng-template" id="recover.html"  class="panel">

    <?= \Form::open(array('action' => 'user/password/recover', 'class' => 'form-signin', 'ng-class' => 'class')); ?>
    <h2 class="form-signin-heading">Recover lost password</h2>
    <div class="form-group">
        <label class=" " for="email">Email Address</label>
        <input type="email" class="form-control" name="email" placeholder="<?= __('user.model.email'); ?>" autofocus="">
    </div>

    <p class="text-center">
        <button type="submit" class="btn btn-muted btn-lg"  ><?= __('user.login.recover'); ?></button>
    </p>

    <?= \Form::close(); ?>
    <a ng-click="setTpl('register.html')" >Not a member of WSJ? Click here to get full access.</a>
</script>
