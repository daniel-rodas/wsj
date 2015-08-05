<h2>Listing <span class='muted'>Notes</span></h2>
<p>
    <?php echo Html::anchor('frontend/note/create', 'Add new note', array('class' => 'btn btn-success')); ?>

</p>
<br>
<?php if ($notes): ?>
<div class="container table table-striped">

<?php foreach ($notes as $item): ?>		<div class="row">
    <hr />
			<section class="col-md-10">
                <h3><?php echo $item->title; ?></h3>
                <p><?php echo $item->body; ?></p>
            </section>
			<aside class="col-md-2">
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('frontend/note/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>
						<?php echo Html::anchor('frontend/note/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>
						<?php echo Html::anchor('frontend/note/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</aside>
		</div><!-- Row -->
<?php endforeach; ?>
</div>

<?php else: ?>
<p>No notes.</p>

<?php endif; ?>
