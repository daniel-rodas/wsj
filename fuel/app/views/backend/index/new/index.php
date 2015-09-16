

<?//= View::forge()->render('backend/index/new/_buyoption'); ?>



<div class="container">
    <header class="row">
        <div class="col-md-6"  ng-controller="CreateController as COC" >
            <h2>Create New Option</h2>
            <p>Category: {{COC.category}}, Timeframe {{COC.timeframe}}, Coin {{COC.coinName}}</p>
            <p>Expiration Date: {{COC.expirationDate * 1000 | date:'medium'}}</p>
            <p>Strike: {{COC.strikePrice}}</p>

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

                <h4>ApexCoin</h4>
                <div class="row">
                    <div class="list-group col-md-3">

                        <p class="list-group-item  lead "> Bid  <span class="badge">0.44663</span></p>
                        <hr>
                        <p class="lead list-group-item ">Ask <span class="badge">0.43677</span></p>
                    </div>
                    <div class="list-group col-md-3">
                        <p class="lead list-group-item ">Last <span class="badge">0.43677</span></p>
                        <hr>
                        <p class="lead list-group-item ">Strike <span class="badge">0.4543</span> </p>
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
                    <div  class="col-md-12 " id="coin-choice">
                        <section class="row">
                            <img src="/assets/img/coin/1.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/2.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/3.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/3.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                        </section>
                        <section class="row">
                            <img src="/assets/img/coin/4.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/4.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/bitsharesx.jpg" alt="" class="col-md-3 img-responsive img-thumbnail"/>
                            <img src="/assets/img/coin/3.png" alt="" alt="Choose a Coin" class="col-md-3 img-responsive img-thumbnail"/>
                        </section>
                    </div><!-- End. Button Group-->
                </div>
            </section>

            <div class="col-md-offset-1 col-md-5 btn-group-vertical"><!-- Form COntrols -->

                <div ng-controller="QuantityController as QTC" class="input-group">
                    <h4>Quantity <span></span></h4>
                    <div class="input-group">
                        <div class="btn-group">
                            <input type="range" min="5" max="200" step="5" value="100" /><br/>
                        </div>
                    </div>
                </div>
                <div ng-controller="CategoryController as CC" class="input-group">
                    <h4>Category <span>{{CC.radioModel}}</span></h4>
                    <div class="btn-group btn-group-lg btn-group-justified">
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'put'" >Put</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'call'" >Call</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'short'" >Short</label>
                        <label class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'future'" >Future</label>
                    </div>
                </div>

                <div ng-controller="TimeframeController as TFC"  class="input-group">
                    <h4>Time Frame <span></span></h4>
                    <div class="btn-group btn-group-lg btn-group-justified">
                        <label class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'30m'">30 minutes</label>
                        <label class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'90m'">90 minutes</label>
                        <label class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'6h'">6 hours</label>
                        <label class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'1d'">1 day</label>
                        <label class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'7d'">7 days</label>
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
