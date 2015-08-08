<h2>Editing <span class='muted'>Market_history</span></h2>
<br>

<?= \Theme::instance()->view('market/history/_form'); ?>
<p>
	<?php echo Html::anchor('market/history/view/'.$market_history->id, 'View'); ?> |
	<?php echo Html::anchor('market/history', 'Back'); ?></p>
