<h2>Editing <span class='muted'>Coin</span></h2>
<br>
<?php echo render('coin/_form', array('coin' => $coins ) ); ?>

<p>
	<?php echo Html::anchor('coin/view/'.$coins->id, 'View'); ?> |
	<?php echo Html::anchor('coin', 'Back'); ?></p>
