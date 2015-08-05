

<?php echo render('backend/index/sendcoin/_form', array('user_id' => $user_id, 'addresses' => $addresses)); ?>

<p><?php echo Html::anchor('backend/sendcoin', 'Back'); ?></p>
