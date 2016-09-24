<nav class="sr-only">
    <div class="modal-header">
        <div class="row">
            <h1 class="h1  col-xs-10 col-sm-10 col-md-11 col-lg-11"><a href="/">WSJ Sections</a></h1>
            <a href="" class=" col-xs-1 col-sm-1 col-md-1 col-lg-1"  ng-click="NC.cancel()">close  </a>
        </div>
        <div class="row">
            <ul class="nav nav-pills nav-sections" >

<!--                <li ng-repeat="category in categories "  ><a ng-click="NC.getNavSubCategories(category.slug)"  href=""> {{NC.category.name}}</a></li>-->

            </ul>
        </div>
        <div class="row">
            <hr style="border-top: 1px solid #444;" />
<!--            <h2 class="text-center modal-title col-md-11">{{ subCategories.section }}</h2>-->
        </div>
    </div>
    <div class="modal-body nav-section-stories">
<!--        <div ng-repeat="subCategory in subCategories"  class="row sub-section" >-->
<!--            <article class="col-xs-3 col-sm-2 col-md-2" >-->
<!--                <a href="category/{{NC.subCategory.slug}}" class="story">-->
<!--                    <h3> {{subCategory.name}}</h3>-->
<!--                </a>-->
<!--            </article>-->
<!--            <div class="col-xs-9 col-sm-10 col-md-10">-->
<!--                <section class="row">-->
<!--                    <article ng-repeat="post in subCategory.posts" class="col-xs-12 col-sm-6 col-md-4" >-->
<!---->
<!--                        <!--                    <img ng-if="getSource(NC.post.galleries)" class="img-responsive" src="{{NC.getSource(post.galleries)}}" alt="Powell Street"/>-->-->
<!---->
<!--                        <a href="/{{post.slug}}" class="story">-->
<!--                            <!--                        <h2>{{post.name | limitTo:letterLimitHeadline }}</h2>-->-->
<!--                            <p>-->
<!--                                <!--                            {{post.content | limitTo:letterLimit }}-->-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </article>-->
<!--                </section>-->
<!--            </div>-->
<!---->
<!--        </div> <!-- End/ .row  -->-->

    </div>
    <div class="modal-footer">
        <article style="background-color: #a6e1ec; height: 5rem;" class="col-md-4">
            Advertisement
        </article>
        Copyright WSJ

    </div>
</nav>
