<h2>Viewing <span class='muted'>#<?php echo $note->id; ?></span></h2>

<p>
	<strong>Body:</strong>
	<?php echo $note->body; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $note->title; ?></p>

<?php echo Html::anchor('frontend/note/edit/'.$note->id, 'Edit'); ?> |
<?php echo Html::anchor('frontend/note', 'Back'); ?>