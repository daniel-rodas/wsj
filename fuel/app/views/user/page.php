

    <div class="row">

        <section class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">


                        <?= View::forge()->render('_includes/session_flash'); ?>
                        <?=  isset($content) ? $content : null ; ?>


        </section>


    </div>
    <p>User Layout</p>


