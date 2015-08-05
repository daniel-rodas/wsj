<h2>Viewing <span class='muted'>#<?php echo $option->serial; ?></span></h2>

<p>
	<strong>id:</strong>
	<?php echo $option->serial; ?></p>
<p>
    <strong>Expiration date:</strong>
    <?php echo $option->expiration_date; ?></p>
<p>
	<strong>Market:</strong>
	<?php echo 'GET MARKET api'; ?></p>
<p>
	<strong>Strike:</strong>
	<?php echo $option->strike; ?></p>
<p>
	<strong>Coin:</strong>
	<?php echo $option->coins->name; ?></p>
<p>
	<strong>Quantity:</strong>
	<?php echo $option->quantity; ?></p>
<p>
	<strong>Purchase:</strong>
	<?php echo $option->price; ?></p>
<p>
	<strong>Category:</strong>
	<?php echo $option->category; ?></p>

<?php echo Html::anchor('option/edit/'.$option->id, 'Edit'); ?> |
<?php echo Html::anchor('option', 'Back'); ?>