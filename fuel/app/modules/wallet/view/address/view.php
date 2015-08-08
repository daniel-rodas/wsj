<h2>Viewing <span class='muted'>#<?php echo $address->id; ?></span></h2>

<p>
	<strong>Address:</strong>
	<?php echo $address->address; ?></p>
<p>
	<strong>Coin:</strong>
	<?php echo $address->coin; ?></p>

<?php echo Html::anchor('address/edit/'.$address->id, 'Edit'); ?> |
<?php echo Html::anchor('address', 'Back'); ?>