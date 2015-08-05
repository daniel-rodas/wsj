<h2>Editing <span class='muted'>Address</span></h2>
<br>

<?php echo render('address/_form'); ?>
<p>
	<?php echo Html::anchor('address/view/'.$address->id, 'View'); ?> |
	<?php echo Html::anchor('address', 'Back'); ?></p>
