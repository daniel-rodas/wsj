<div class="panel-heading">
    <h2>Basic Information</h2>
</div>

<br>
<div  style="padding: 1.634rem"  class="panel-body">
    <?= View::forge()->render('_includes/message'); ?>
    <?php if ($user): ?>

        <p>
            <strong>First:</strong>
            <?php echo (isset($user->firstname) ? $user->firstname : 'Please update First Name'); ?></p>
        <p>
            <strong>Last:</strong>
            <?php echo (isset($user->firstname) ? $user->lastname : 'Please update Last Name'); ?></p>
        <p>
            <strong>Email:</strong>
            <?php echo $user->email; ?></p>


        <?php echo Html::anchor('backend/account/basic/'.$user->id, 'Edit'); ?>



    <?php else: ?>
        <p>No user.</p>

    <?php endif; ?>
</div>

