<?php if ($optionsSell): ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6" id="profile" style="margin-top: 25px;">
        <p class="lead text-center">Sell or Execute on your options</p>
        <table class="table table-bordered table-hover table-condensed table-responsive">
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
                    <?php   echo '<td><p>' . $info->result->Last . '</p></td>'; ?>
            <td><?php echo $item->strike; ?></td>
            <td><?php echo $item->coins->name; ?></td>

            <td><?php echo $item->quantity; ?></td>
            <td><?php echo $item->price; ?></td>
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