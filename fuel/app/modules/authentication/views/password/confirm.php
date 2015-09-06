<div class="col-md-6 col-md-offset-3">
    <h1>WSJ Password Confirm Request</h1>
    <p>Good news, we found your account <?= $user->email; ?></p>
    <p>Do you want to confirm by email or phone?</p>
    <section class="form-inline">
        <div class="form-group">
            <a href="<?= \Uri::create('authentication/password/mock_email/' . $user->id ); ?>"><button  class="btn btn-muted btn-lg">Email</button></a>

        </div>
        <div class="form-group">
            <a href="<?= \Uri::create('authentication/password/mock_phone/' . $user->id ); ?>"><button  class="btn btn-muted btn-lg">Phone</button></a>
        </div>
    </section>



    <?= Html::anchor('user/login', 'Already a member? Sign In'); ?>
</div>

