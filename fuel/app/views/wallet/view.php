<h2>Viewing <span class='muted'>#<?php echo $wallet->id; ?></span></h2>

<p>
	<strong>Address id:</strong>
	<?php echo $wallet->address_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $wallet->user_id; ?></p>

<?php echo Html::anchor('wallet/edit/'.$wallet->id, 'Edit'); ?> |
<?php echo Html::anchor('wallet', 'Back'); ?>