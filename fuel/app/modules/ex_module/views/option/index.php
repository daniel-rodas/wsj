<h2>Listing <span class='muted'>Options</span></h2>
<br>
<?php if ($options): ?>
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Time</th>
                <th>Market</th>
                <th>Strike</th>
                <th>Coin</th>
                <th>Quantity</th>
                <th>Purchase</th>
                <th>Category</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($options as $item): ?>		<tr>

                <td><?php echo $item->serial; ?></td>
                <td><?php echo $item->expiration_date; ?></td>
                <td><?php echo 'GET MARKET API'; ?></td>
                <td><?php echo $item->strike; ?></td>
                <td><?php echo $item->coins->name; ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><?php echo $item->price; ?></td>
                <td><?php echo $item->category; ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('option/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>
                            <?php echo Html::anchor('option/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>
                            <?php echo Html::anchor('option/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete',
                                array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                        </div>
                    </div>

                </td>
            </tr>
            <?php endforeach; ?>	</tbody>
        </table>
    </div>

</div>


<?php else: ?>
<p>No Options.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('option/create', 'Add new Option', array('class' => 'btn btn-success')); ?>

</p>
