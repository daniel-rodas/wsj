
<div class="container-fluid">
    <div class="row" style="margin-left: 10px; margin-top: 25px;">

        <div class="col-md-6 col-md-offset-3"><p class="text-center lead">Search Criteria</p>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 4
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 5
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 6
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 7
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> 8
            </label>
        </div>
    </div>
    <div class="row" style="margin-left: 10px; margin-top: 25;">
        <div class="col-md-4"><p class="lead text-right" style="margin: 7px;">Keyword</p></div>
        <div class="col-md-4">
            <div class="input-group" style="margin-top: 10px;">
                      <span class="input-group-addon">
                        <input type="radio">
                      </span>
                <input type="text" class="form-control">
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

</div>


<?php if ($optionsBuy): ?>
    <div class="row">
        <h2 class="lead text-center">Buy some options</h2>
        <div class="table-responsive" style="margin-top: 25px;">

            <table class="table table-bordered table-hover table-condensed ">
                <thead>
                <tr>
                    <th>Expires</th>
                    <th>Market$</th>
                    <th>Strike$</th>
                    <th>Coin</th>
                    <th>Quantity</th>
                    <th>Purchase$</th>
                    <th>Category</th>
                    <th>Buy</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($optionsBuy as $item): ?>
                    <tr>
                        <td><small><?php  echo Date::forge($item->expiration_date)->format("%m/%d %H:%M"); ?></small></td>
                            <?php $info = \Market\Market::getMarketInfo($item->coins); ?>
                            <?php echo '<td><p>' . number_format($info->result->Last, 5) . '</p></td>'; ?>
                        <td><?php echo number_format($item->strike, 5); ?></td>
                        <td><?php echo $item->coins->name; ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td><?php echo number_format($item->price, 5); ?></td>
                        <td><?php echo $item->category; ?></td>
                        <td><button class="btn btn-success option-buy" data-itemid="<?php echo $item->id; ?>" data-toggle="modal" data-target="#optionModal">Buy</button></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- End. class="col-md-6" id="profile" -->
    </div><!-- End Row -->
<?php else: ?>
    <p>No Options.</p>

<?php endif; ?>