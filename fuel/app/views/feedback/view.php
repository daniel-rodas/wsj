<h2>Viewing <span class='muted'>#<?php echo $feedback->id; ?></span></h2>

<p>
	<strong>Feedback:</strong>
	<?php echo $feedback->feedback; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $feedback->user_id; ?></p>

<?php echo Html::anchor('feedback/edit/'.$feedback->id, 'Edit'); ?> |
<?php echo Html::anchor('feedback', 'Back'); ?>