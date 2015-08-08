<h2>Listing <span class='muted'>Addresses</span></h2>
<br>
<?php if ($addresses): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Address</th>
			<th>Coin</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($addresses as $item): ?>		<tr>

			<td><?php echo $item->address; ?></td>
			<td><?php echo $item->coin; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('address/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('address/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('address/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Addresses.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('address/create', 'Add new Address', array('class' => 'btn btn-success')); ?>

</p>
