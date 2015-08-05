<h2>Viewing <span class='muted'>#<?php echo $market_history->id; ?></span></h2>

<p>
	<strong>Market:</strong>
	<?php echo $market_history->market; ?></p>
<p>
	<strong>Coin id:</strong>
	<?php echo $market_history->coin_id; ?></p>
<p>
	<strong>Last price:</strong>
	<?php echo $market_history->last_price; ?></p>
<p>
	<strong>Api url:</strong>
	<?php echo $market_history->api_url; ?></p>

<?php echo Html::anchor('market/history/edit/'.$market_history->id, 'Edit'); ?> |
<?php echo Html::anchor('market/history', 'Back'); ?>