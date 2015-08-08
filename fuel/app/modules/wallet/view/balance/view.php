<h2>Viewing <span class='muted'>#<?php echo $balance->id; ?></span></h2>

<p>
	<strong>Description:</strong>
	<?php echo $balance->description; ?></p>
<p>
	<strong>Debit:</strong>
	<?php echo $balance->debit; ?></p>
<p>
	<strong>Credit:</strong>
	<?php echo $balance->credit; ?></p>
<p>
	<strong>Balance:</strong>
	<?php echo $balance->balance; ?></p>

<?php echo Html::anchor('balance/edit/'.$balance->id, 'Edit'); ?> |
<?php echo Html::anchor('balance', 'Back'); ?>