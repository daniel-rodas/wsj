<h2>Editing <span class='muted'>Basic Information</span></h2>
<br>
<?php echo render('account/basic/_form', array('user' => $user ) ); ?>

<?php echo Html::anchor('backend/account/basic/', 'Back'); ?>