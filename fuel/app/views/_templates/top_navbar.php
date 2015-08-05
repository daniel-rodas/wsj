<nav  ng-controller="controllerHeader" id="navigation-user">


    <ul class="nav navbar-right nav-pills">

        <li><a  ng-click="open('section-menu')">

                Sections <span  class="glyphicon glyphicon-th-list" aria-hidden="true"></span> </a></li>


        <?php if(isset($user_email)): ?>

        <li role="presentation" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Str::truncate($user_email, 15);  ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= \Router::get('backend_account'); ?>">Account</a></li>
                <li><a href="<?= \Router::get('backend_account_save'); ?>">Saved Items</a></li>
                <li class="divider"></li>
                <li><a href="#">Customer Service</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><?php echo Html::anchor('user/logout','Logout') ?></li>
            </ul>
        </li>
    <?php else: ?>
        <li class="login-or-register"><?php echo Html::anchor('user/service/index/login', 'Login'); ?> </li>

        <li class="login-or-register"><?php echo Html::anchor('user/service/index/register', 'Subscribe'); ?> </li>
    <?php endif ?>


        <li role="presentation" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Language</a></li>
                <li><a href="#">Type Size</a></li>
                <li class="divider"></li>
                <li><a href="#">Share</a></li>
            </ul>
        </li>
    </ul>


        <script type="text/ng-template" id="myModalContent.html">

            <div class="modal-header">
                <div class="row">
                    <h1 class="h1  col-xs-10 col-sm-10 col-md-11 col-lg-11"><a href="/">WSJ Sections</a></h1>
                    <a href="" class=" col-xs-1 col-sm-1 col-md-1 col-lg-1"  ng-click="cancel()">close  </a>
                </div>
                <div class="row">
                    <ul class="nav nav-pills nav-sections" >

                        <li ng-repeat="category in categories "  ><a ng-click="getNavSubCategories(category.slug)"  href=""> {{category.name}}</a></li>

                    </ul>
                </div>
                <div class="row">
                    <hr style="border-top: 1px solid #444;" />
                    <h2 class="text-center modal-title col-md-11">{{ subCategories.section }}</h2>
                </div>
            </div>
            <div class="modal-body nav-section-stories">
                <div ng-repeat="subCategory in subCategories"  class="row sub-section" >
                    <article class="col-xs-3 col-sm-2 col-md-2" >
                        <a href="category/{{subCategory.slug}}" class="story">
                            <h3> {{subCategory.name}}</h3>
                        </a>
                    </article>
                    <div class="col-xs-9 col-sm-10 col-md-10">
                        <section class="row">
                            <article ng-repeat="post in subCategory.posts" class="col-xs-12 col-sm-6 col-md-4" >

                                <img ng-if="getSource(post.galleries)" class="img-responsive" src="{{getSource(post.galleries)}}" alt="Powell Street"/>

                                <a href="/{{post.slug}}" class="story">
                                    <h2>{{post.name | limitTo:letterLimitHeadline }}</h2>
                                    <p>
                                        {{post.content | limitTo:letterLimit }}
                                    </p>
                                </a>
                            </article>
                        </section>
                    </div>

                </div> <!-- End/ .row  -->

            </div>
            <div class="modal-footer">
                <article style="background-color: #a6e1ec; height: 5rem;" class="col-md-4">
                    Advertisement
                </article>
                Copyright WSJ

            </div>
        </script>







</nav>



