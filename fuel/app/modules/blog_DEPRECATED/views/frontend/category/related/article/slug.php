<?php if(empty($related_categories)): ?>

    <div class="advertisement blog-post-related ">
        <p>Advertisement</p>
    </div>
<?php else: ?>
    <div class=" categories-related">
        <h3>Related Sections</h3>

            <?php foreach($related_categories as $cat): ?>

                    <span class="label label-info"  id="category-related-<?php echo $cat->id; ?>" >

                        <a href="<?= \Router::get('show_post_category', array('category' => $cat->slug)); ?>"><?= $cat->name; ?></a>


                </span>




            <?php endforeach; ?>

    </div>
<?php endif; ?>