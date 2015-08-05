<h2>Listing <span class='muted'>Market_histories</span></h2>
<br>
<?php if ($market_histories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Market</th>
			<th>Coin id</th>
			<th>Last price</th>
			<th>Api url</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($market_histories as $item): ?>		<tr>

			<td><?php echo $item->market; ?></td>
			<td><?php echo $item->coin_id; ?></td>
			<td><?php echo $item->last_price; ?></td>
			<td><?php echo $item->api_url; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('market/history/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('market/history/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('market/history/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Market_histories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('market/history/create', 'Add new Market history', array('class' => 'btn btn-success')); ?>

</p>
