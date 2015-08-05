<h2>Editing <span class='muted'>Note</span></h2>
<br>


<?= \Theme::instance()->view('frontend/note/_form', array('notes' => $note )); ?>
<p>
	<?php echo Html::anchor('frontend/note/view/'.$note->id, 'View'); ?> |
	<?php echo Html::anchor('frontend/note', 'Back'); ?></p>
