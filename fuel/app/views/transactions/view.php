<h2>Viewing <span class='muted'>#<?php echo $transaction->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $transaction->user_id; ?></p>
<p>
	<strong>Option id:</strong>
	<?php echo $transaction->option_id; ?></p>
<p>
	<strong>Action:</strong>
	<?php echo $transaction->action; ?></p>
<p>
	<strong>Purchase:</strong>
	<?php echo $transaction->purchase; ?></p>

<?php echo Html::anchor('transactions/edit/'.$transaction->id, 'Edit'); ?> |
<?php echo Html::anchor('transactions', 'Back'); ?>