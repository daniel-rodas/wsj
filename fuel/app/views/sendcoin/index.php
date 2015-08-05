<h2>Listing <span class='muted'>Sendcoins</span></h2>
<br>
<?php if ($sendcoins): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Address id</th>
			<th>User id</th>
			<th>Quantity</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sendcoins as $item): ?>		<tr>

			<td><?php echo $item->address_id; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->quantity; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('sendcoin/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('sendcoin/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('sendcoin/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Sendcoins.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('sendcoin/create', 'Add new Sendcoin', array('class' => 'btn btn-success')); ?>

</p>
