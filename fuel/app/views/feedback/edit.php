<h2>Editing <span class='muted'>Feedback</span></h2>
<br>

<?php echo render('feedback/_form'); ?>
<p>
	<?php echo Html::anchor('feedback/view/'.$feedback->id, 'View'); ?> |
	<?php echo Html::anchor('feedback', 'Back'); ?></p>
