<h2>Listing <span class='muted'>Feedbacks</span></h2>
<br>
<?php if ($feedbacks): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Feedback</th>
			<th>User id</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($feedbacks as $item): ?>		<tr>

			<td><?php echo $item->feedback; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('feedback/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('feedback/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('feedback/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Feedbacks.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('feedback/create', 'Add new Feedback', array('class' => 'btn btn-success')); ?>

</p>
