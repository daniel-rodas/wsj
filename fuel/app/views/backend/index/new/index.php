
<div class="list-group col-md-3">
    <p class="list-group-item  lead coin-selected-notice">
        Coin Selected :
        <img id="coin-selected" src="" alt="" alt="Choose a Coin"
        class=" img-responsive img-rounded"/>

    </p>

    <p id="strike-price" class="lead list-group-item ">Strike Price : <span></span> </p>

    <p id="purchase-price" class="lead list-group-item "> Purchase Price : <span></span></p>
</div>


<?= View::forge()->render('backend/index/new/_buyoption'); ?>
<div  class="col-md-4 btn-group" id="coin-choice">

    <?php if (isset($coins)): ?>
        <?php foreach ($coins as $item): ?>
            <a type="button" class="btn btn-default"><?=
                Asset::img('coin/' . $item->file,
                    array('data-coinid' => $item->id,'data-name' => $item->name, 'alt' => $item->alt, 'style' => 'width:3.5em',
                        'class' => 'img-responsive img-rounded', 'tabindex' => '-1',)); ?>
            </a>
        <?php endforeach; ?>
    <?php else: ?>

        <p>No Coins.</p>
    <?php endif; ?>
</div><!-- End. Button Group-->


<div class="col-md-4 btn-group-vertical"><!-- Form COntrols -->

    <div class="input-group">
        <span class="input-group-addon">qty. #</span>
        <input id="quantity-input" type="number" class="form-control">
    </div>
    <div class="btn-group dropup ">
        <button class="btn btn-default  timeframe-text btn-block" type="button" id="optiontype"
                data-toggle="dropdown">
            Timeframe
            <span class="caret"></span>
        </button>
        <ul id="timeframe-list" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <!--                        <li role="presentation"><a role="menuitem" tabindex="-1" data-timeframe="30m">30m</a></li>-->
            <!--                        <li role="presentation"><a role="menuitem" tabindex="-1" data-timeframe="90m">90m</a></li>-->
            <li role="presentation"><a role="menuitem" tabindex="-1" data-timeframe="6h">6h</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-timeframe="1d">1d</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-timeframe="7d">7d</a></li>
        </ul>
    </div>

    <div class="btn-group dropup">
        <button class="btn btn-default  btn-block  option-text" type="button" id="optiontype"
                data-toggle="dropdown">
            Option
            <span class="caret"></span>
        </button>
        <ul id="option-list" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" data-option="Future">Future</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-option="Call">Call</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-option="Put">Put</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-option="Short">Short</a></li>
        </ul>
    </div>


    <button class="btn btn-success btn-lg review-option" data-toggle="modal"
            data-target=".bs-example-modal-lg">Buy
    </button>
</div>


<div class="container">
    <div class="row">
        <div col="col-md-4" style="margin-top: 10px;">

        </div>
        <?= View::forge()->render('backend/index/new/review'); ?>
    </div>
</div>