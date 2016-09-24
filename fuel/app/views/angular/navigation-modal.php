<template ngbModalContainer></template>
<template #content let-c="close" let-d="dismiss">
    <div class="modal-header">
        <button type="button" class="close" aria-label="Close" (click)="d('Cross click')">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="row">
            <h1 class="h1  col-xs-10 col-sm-10 col-md-11 col-lg-11"><a href="/">WSJ Sections</a></h1>

        </div>
        <div class="row">
            <ul class="nav nav-pills nav-sections" >

                <li  ><a  href=""> category.name</a></li>

            </ul>
        </div>
        <div class="row">
            <hr style="border-top: 1px solid #444;" />
            <h2 class="text-center modal-title col-md-11">subCategories.section</h2>
        </div>
    </div>
    <div class="modal-body">
        <div  class="row sub-section" >
            <article class="col-xs-3 col-sm-2 col-md-2" >
                <a href="category/subCategory.slug" class="story">
                    <h3> subCategory.name</h3>
                </a>
            </article>
            <div class="col-xs-9 col-sm-10 col-md-10">
                <section class="row">
                    <article  class="col-xs-12 col-sm-6 col-md-4" >

                        <img class="img-responsive"  alt="Powell Street"/>

                        <a href="/post.slug" class="story">
                            <h2>post.name | limitTo:letterLimitHeadline </h2>
                            <p>post.content | limitTo:letterLimit

                            </p>
                        </a>
                    </article>
                </section>
            </div>

        </div> <!-- End/ .row  -->
    </div><!-- end./ modal-body -->
    <div class="modal-footer">
        <article style="background-color: #a6e1ec; height: 5rem;" class="col-md-4">
            Advertisement
        </article>
        Copyright WSJ
        <button type="button" class="btn btn-secondary" (click)="c('Close click')">Close</button>
    </div>
</template>

<span (click)="open(content)"  class="glyphicon glyphicon-th-list" aria-hidden="true"></span>


