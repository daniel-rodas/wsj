<h2>Welcome <span class='muted'>#<?php echo $user->firstname; ?></span></h2>

<p>
	<strong>First:</strong>
	<?php echo $user->firstname; ?></p>
<p>
	<strong>Last:</strong>
	<?php echo $user->lastname; ?></p>
<p>
	<strong>API:</strong>
	<?php echo $user->email; ?></p>


<?php echo Html::anchor('basic/edit/'.$user->id, 'Edit'); ?> |
<?php echo Html::anchor('basic', 'Back'); ?>