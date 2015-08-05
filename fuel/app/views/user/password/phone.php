PHONE VIEW

<h1>Your WSJ Password Recovery Request</h1>
<p>We were able to find your user account using <?= $user->email; ?></p>
<p>Please enter the pin from your phone</p>
<?= \Form::open(array('action' => 'user/login','class' => 'form-signin')); ?>
<h2 class="form-signin-heading" xmlns="http://www.w3.org/1999/html">Please sign in</h2>
<div class="form-group">
    <?= Form::label('PIN', 'pin', array('class'=>'control-label')); ?>
    <input type="text" class="form-control" name="username" placeholder="PIN" autofocus="">
</div>

<p class="text-center">
   <button class="btn btn-lg btn-primary" ><a style="color: darkblue;" href="<?= $url; ?>" >Recover Password </a></button>

</p>
<?= Html::anchor( Router::get('password_recover')  , 'Trouble siging in? Click here to reset your password'); ?>
<?= \Form::close(); ?>

<p>Questions? Visit our our customer support site. Don't reply to this email. It was automatically generated.</p>
