<h2>Listing <span class='muted'>Balances</span></h2>
<br>
<?php if ($balances): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Description</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Balance</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($balances as $item): ?>		<tr>

			<td><?php echo $item->description; ?></td>
			<td><?php echo $item->debit; ?></td>
			<td><?php echo $item->credit; ?></td>
			<td><?php echo $item->balance; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('balance/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('balance/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('balance/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Balances.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('balance/create', 'Add new Balance', array('class' => 'btn btn-success')); ?>

</p>
