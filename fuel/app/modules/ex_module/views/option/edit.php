<h2>Editing <span class='muted'>Option</span></h2>
<br>

<?php echo render('option/_form', array('option' => $option )); ?>
<p>
	<?php echo Html::anchor('option/view/'.$option->id, 'View'); ?> |
	<?php echo Html::anchor('option', 'Back'); ?></p>
