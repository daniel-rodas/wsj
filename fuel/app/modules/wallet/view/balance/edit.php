<h2>Editing <span class='muted'>Balance</span></h2>
<br>

<?php echo render('balance/_form'); ?>
<p>
	<?php echo Html::anchor('balance/view/'.$balance->id, 'View'); ?> |
	<?php echo Html::anchor('balance', 'Back'); ?></p>
