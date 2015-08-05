<div class="panel-heading">
    <h2>Saved Articles</h2>
</div>
<br>
<div  style="padding: 1.634rem"  class="panel-body">
    <?= View::forge()->render('_includes/message'); ?>
<?php if ($user): ?>

        <p>
            <strong>Title</strong>
            <?php echo (isset($user->delivery_address) ? $user->delivery_address : 'Please update Delivery Address'); ?></p>
        <p>
            <strong>Author</strong>
            <?php echo (isset($user->delivery_address_2) ? $user->delivery_address_2 : 'Please update Line 2'); ?></p>
        <p>
            <strong>Date</strong>
            <?php echo (isset($user->delivery_address_2) ? $user->delivery_address_2 : 'Please update Line 2'); ?></p>
        <p>
            <strong>Category</strong>
            <?php echo (isset($user->delivery_city) ? $user->delivery_city : 'Please update City'); ?></p>
        <p>
            <strong>Date Saved</strong>
            <?php echo (isset($user->delivery_state) ? $user->delivery_state : 'Please update State'); ?></p>



        <?php echo Html::anchor('backend/account/save/'.$user->id, 'Edit'); ?>



<?php else: ?>
<p>No user.</p>

<?php endif; ?>
</div>