<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row">
                    <h2 class="text-center lead" style="text-size: 30px;">Thanks for placing your order on GryfX!</h2>
                    <div class="col-md-4">
                        <?= Asset::img('orderup.jpg',
                            array( 'alt' =>  'GryfX Order Up' , 'class' => ' img-responsive img-rounded')); ?>
                    </div>
                    <div class="col-md-8">
                        <?= View::forge()->render('backend/_templates/breadcrumbs'); ?>

                        <div class="row" style="margin: 15px; >
                            <p class="lead text-left" style="margin-left: 15px">After purchase your option will be found in the Options tab above.  You can sell it, execute on it, or do nothing(puts &amp; calls).  Have fun and play safe :)
                            </p>
                            <div class="row">
                                <?php echo Form::submit('submit', 'Purchase &amp; Parlay', array('class' => 'btn btn-success btn-lg')); ?>
                                <a  class="btn btn-primary btn-lg" href="<?= \Router::get('backend_option'); ?>" class="btn btn-primary">Other options</a>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
