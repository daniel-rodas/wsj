<?php if ($options): ?>
<table class="table table-bordered table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th>id</th>
			<th>Purchase date</th>
			<th>Market</th>
			<th>Strike</th>
			<th>Coin</th>
			<th>Quantity</th>
			<th>Purchase</th>
			<th>Category</th>
            <th>Sell</th>
            <th>Execute</th>

	</thead>
	<tbody>
<?php foreach ($options as $item): ?>		<tr>

			<td><?php echo $item->id; ?></td>
			<td><?php // echo $item->purchase_date; ?></td>
			<td><?php echo 'GET MARKET API'; ?></td>
			<td><?php echo $item->strike; ?></td>
			<td><?php echo $item->coin_id; ?></td>
			<td><?php echo $item->quantity; ?></td>
			<td><?php echo $item->price; ?></td>
			<td><?php echo $item->category; ?></td>
            <td><button type="button" class="btn btn-sm btn-danger">Sell</button>
            <td><button type="button" class="btn btn-sm btn-success">Execute</button></td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Options.</p>

<?php endif; ?><p>


</p>
