<div class="modal fade " id="optionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><p class="text-center lead" style="font-size: 30px;">Execute on Option!</p></h4>
      </div>
      <div class="modal-body">
          <div class="col-md-4">
          <?=\Theme::instance()->asset->img('orderup.jpg',
              array( 'alt' =>  'GryfX Order Up' , 'class' => 'col-md-6 img-responsive img-rounded')); ?>
          </div>
          <?= \Theme::instance()->view('backend/_templates/breadcrumbs'); ?>
          <p class="lead">$$$$ Expected Gain</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button"  data-dismiss="modal" class="btn btn-success btn-lg option-confirm">Go!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->








