<h2>Listing <span class='muted'>Coins</span></h2>
<br>
<?php if ($coins): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>file</th>
			<th>Alt Text</th>
			<th>API</th>
			<th>Market Label</th>
			<th>id (PK)</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($coins as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->file; ?></td>
			<td><?php echo $item->alt; ?></td>
			<td><?php echo $item->api; ?></td>
			<td><?php echo $item->market; ?></td>
			<td><?php echo $item->id; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('coin/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('coins/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('coins/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Coins.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('coin/create', 'Add new Coin', array('class' => 'btn btn-success')); ?>

</p>
