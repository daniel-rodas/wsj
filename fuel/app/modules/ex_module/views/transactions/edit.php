<h2>Editing <span class='muted'>Transaction</span></h2>
<br>

<?php echo render('transactions/_form', array('transactions' => $transactions )); ?>

<p>
	<?php echo Html::anchor('transactions/view/'.$transactions->id, 'View'); ?> |
	<?php echo Html::anchor('transactions', 'Back'); ?></p>
