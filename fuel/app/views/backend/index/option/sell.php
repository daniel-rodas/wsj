<?php if ($optionsSell): ?>
<div class="row">
    <h2 class="lead text-center">Sell or Execute on your options</h2>
    <div class="table-responsive">

        <table class="table table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th>Expires</th>
            <th>Market</th>
            <th>Strike</th>
            <th>Coin</th>
            <th>Quantity</th>
            <th>Purchase</th>
            <th>Category</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($optionsSell as $item): ?>
            <tr>
            <td><small><?php  echo Date::forge($item->expiration_date)->format("%m/%d %H:%M"); ?></small></td>
                    <?php $info = \Market\Market::getMarketInfo($item->coins); ?>
                    <?php   echo '<td><p>' . number_format($info->result->Last, 5)    . '</p></td>'; ?>
            <td><?php echo number_format($item->strike , 5); ?></td>
            <td><?php echo $item->coins->name; ?></td>

            <td><?php echo $item->quantity; ?></td>
            <td><?php echo number_format($item->price, 5) ; ?></td>
            <td><?php echo $item->category; ?></td>
            <td><button class="btn btn-danger option-sell"  data-itemid="<?php echo $item->id; ?>"    data-toggle="modal" data-target="#optionModal">sell</button></td>
            <td><button class="btn btn-warning option-execute" data-itemid="<?php echo $item->id; ?>"    data-toggle="modal" data-target="#optionModal">Execute</button></td>
        </tr>
        <?php endforeach; ?>	</tbody>
    </table>
    </div><!-- End. class="col-md-6" id="profile" -->
</div><!-- End Row -->
<?php else: ?>
    <p>No Options.</p>
<?php endif; ?>