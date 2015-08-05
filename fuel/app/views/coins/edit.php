<h2>Editing <span class='muted'>Coin</span></h2>
<br>
<?php echo render('coins/_form', array('coin' => $coins ) ); ?>

<p>
	<?php echo Html::anchor('coins/view/'.$coins->id, 'View'); ?> |
	<?php echo Html::anchor('coins', 'Back'); ?></p>
