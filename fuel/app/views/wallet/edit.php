<h2>Editing <span class='muted'>Wallet</span></h2>
<br>

<?php echo render('wallet/_form', array('wallet' => $wallet) ); ?>
<p>
	<?php echo Html::anchor('wallet/view/'.$wallet->id, 'View'); ?> |
	<?php echo Html::anchor('wallet', 'Back'); ?></p>
