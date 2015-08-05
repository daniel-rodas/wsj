<h2>Viewing <span class='muted'>#<?php echo $coin->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $coin->name; ?></p>
<p>
	<strong>file:</strong>
	<?php echo $coin->file; ?></p>
<p>
	<strong>API:</strong>
	<?php echo $coin->api; ?></p>
<p>
	<strong>Market Label:</strong>
	<?php echo $coin->market; ?></p>
<p>
	<strong>ID (PK):</strong>
	<?php echo $coin->id; ?></p>

<?php echo Html::anchor('coins/edit/'.$coin->id, 'Edit'); ?> |
<?php echo Html::anchor('coins', 'Back'); ?>