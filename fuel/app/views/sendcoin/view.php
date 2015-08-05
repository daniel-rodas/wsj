<h2>Viewing <span class='muted'>#<?php echo $sendcoin->id; ?></span></h2>

<p>
	<strong>Address id:</strong>
	<?php echo $sendcoin->address_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $sendcoin->user_id; ?></p>
<p>
	<strong>Quantity:</strong>
	<?php echo $sendcoin->quantity; ?></p>

<?php echo Html::anchor('sendcoin/edit/'.$sendcoin->id, 'Edit'); ?> |
<?php echo Html::anchor('sendcoin', 'Back'); ?>