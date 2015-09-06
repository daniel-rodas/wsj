

<?//= View::forge()->render('backend/index/new/_buyoption'); ?>



<div class="container">
    <header class="row">
        <div class="col-md-6">
            <h2>Create New Option</h2>
        </div>

        <section class="col-md-offset-1 col-md-5">

            <br />

            <div class="row">
                <h4 class="col-md-8">Purchase Price</h4><h4 class="col-md-offset-1 col-md-2">$123.34</h4>
            </div>

            <div class="row">
                <div class="input-group">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">

                        <label class="btn btn-xs btn-warning">Market Place</label>
                        <label class="btn btn-xs btn-success">Purchase Option</label>
                    </div>
                </div>
            </div>





        </section>
    </header>
    <div class="row">

        <div class="row">
            <section class="col-md-6">
                <h4>Coin</h4>
                <div class="row">
                    <div class="list-group col-md-6">
                        <p class="list-group-item  lead coin-selected-notice">
                            Ask Price - <span>0.44663</span>
                        </p>
                        <p id="strike-price" class="lead list-group-item ">Strike Price -  <span>0.4543</span> </p>
                        <p id="purchase-price" class="lead list-group-item ">Last Price - <span>0.43677</span></p>
                    </div>
                    <div class=" col-md-6">
                        <img id="coin-selected" src="/assets/img/coin/history-graph.gif" alt="" alt="Choose a Coin" class=" img-responsive img-rounded"/>
                    </div>
                </div>
                <nav class="row">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="row">
                    <div  class="col-md-12 btn-group" id="coin-choice">

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
                </div>
            </section>

            <div class="col-md-offset-1 col-md-5 btn-group-vertical"><!-- Form COntrols -->
                <h4>Quantity</h4>
                <div class="input-group">
                    <div class="btn-group">
                        <input type="range" min="5" max="200" step="5" value="100" /><br/>
                    </div>
                </div>
                <h4>Category</h4>
                <div ng-controller="CategoryController as CC" class="input-group">
                    <div class="btn-group btn-group-lg btn-group-justified">
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'put'" unchecable>Put</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'call'" uncheckable>Call</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'short'" uncheckable>Short</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'future'" uncheckable>Future</label>
                    </div>
                </div>
                <h4>Time Frame</h4>
                <div ng-controller="TimeframeController as TC"  class="input-group">
                    <div class="btn-group btn-group-lg btn-group-justified">
                        <label class="btn btn-primary" ng-model="TF.checkModel" btn-radio="'30m'">30 minutes</label>
                        <label class="btn btn-primary" ng-model="TF.checkModel" btn-radio="'90m'">90 minutes</label>
                        <label class="btn btn-primary" ng-model="TF.checkModel" btn-radio="'6h'">6 hours</label>
                        <label class="btn btn-primary" ng-model="TF.checkModel" btn-radio="'1d'">1 day</label>
                        <label class="btn btn-primary" ng-model="TF.checkModel" btn-radio="'7d'">7 days</label>
                    </div>
                </div>
            </div>
        </div>

<!--        <div col="col-md-4" style="margin-top: 10px;">-->
<!---->
<!--        </div>-->
        <?= View::forge()->render('backend/index/new/review'); ?>
    </div>
</div>