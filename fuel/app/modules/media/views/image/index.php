<?php if(empty($images)): ?>
<?php else: ?>
	<?php foreach($images as $image): ?>

        <?php if(isset($image->uri)): ?>

            <img src="<?php echo   $image->uri . '' . $image->name;  ?>" class="featured-image img-responsive" />

        <?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

