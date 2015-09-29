

<?//= View::forge()->render('backend/index/new/_buyoption'); ?>



<div class="container">
    <header class="row">
        <div class="col-md-6" >
<!--        <div class="col-md-6"  ng-controller="CreateController as COC" >-->
            <h2>Create New Option</h2>
<!--            <p>Category: {{COC.category}}, Timeframe {{COC.timeframe}}, Coin {{COC.coinName}}</p>-->
<!---->
<!--            <p>Strike: {{COC.strikePrice}}</p>-->

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
            <section ng-controller="SymbolController as SC" class="col-md-6">


                <div ng-if="SC.coin" class="row">

                    <section class="row">
                        <header class="col-md-6">
                            <h4>{{SC.coin.name}}</h4>
                            <h3>{{SC.coin.market}}</h3>
                        </header>
                        <div class=" col-md-6">
                            <img id="coin-selected" src="/assets/img/coin/{{SC.coin.file}}" alt="" alt="Choose a Coin" class=" img-responsive img-rounded"/>
                        </div>
                    </section>
                    <section class="row"></section>
<!--                    <div class="list-group col-md-3">-->
<!---->
<!--                        <p class="list-group-item  lead "> Bid  <span class="badge">0.44663</span></p>-->
<!--                        <hr>-->
<!--                        <p class="lead list-group-item ">Ask <span class="badge">0.43677</span></p>-->
<!--                    </div>-->
                    <div class="list-group col-md-3">
                        <p class="lead list-group-item ">Last <span class="badge">{{SC.coin.lastPrice}}</span></p>
                        <hr>
<!--                        <p class="lead list-group-item ">Strike <span class="badge">0.4543</span> </p>-->
                    </div>
                    <div class=" col-md-6">
                        <img id="coin-selected" src="/assets/img/coin/history-graph.jpg" alt="" alt="Choose a Coin" class=" img-responsive img-rounded"/>
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
                            <img ng-repeat="coin in SC.coins"
                                 src="/assets/img/coin/{{coin.file}}" ng-click="SC.selectSymbol(coin.id)"
                                  alt="{{coin.name}}" class="col-md-3 img-responsive img-thumbnail" />
                        </section>

                    </div><!-- End. Button Group-->
                </div>
            </section>

            <div class="col-md-offset-1 col-md-5 btn-group-vertical"><!-- Form COntrols -->

                <div  class="input-group">
<!--                <div ng-controller="QuantityController as QTC" class="input-group">-->
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
                        <label ng-click="CC.setCat()" class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'put'" >Put</label>
                        <label ng-click="CC.setCat()" class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'call'" >Call</label>
                        <label ng-click="CC.setCat()" class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'short'" >Short</label>
                        <label ng-click="CC.setCat()" class="btn btn-primary" ng-model="CC.radioModel" btn-radio="'future'" >Future</label>
                    </div>
                </div>

                <div  ng-controller="TimeframeController as TFC"    class="input-group">
                    <h4>Time Frame <span></span></h4>
                    <p>Expiration Date: {{TFC.expirationDate * 1000 | date:'medium'}}</p>
                    <div class="btn-group btn-group-lg btn-group-justified">
                        <label ng-click="TFC.getExpirationDate('30m')" class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'30m'">30 minutes</label>
                        <label ng-click="TFC.getExpirationDate('90m')" class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'90m'">90 minutes</label>
                        <label ng-click="TFC.getExpirationDate('6h')" class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'6h'">6 hours</label>
                        <label ng-click="TFC.getExpirationDate('1d')" class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'1d'">1 day</label>
                        <label ng-click="TFC.getExpirationDate('7d')" class="btn btn-primary" ng-model="TFC.radioModel" btn-radio="'7d'">7 days</label>
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
