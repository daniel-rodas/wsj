<h2>Section Categories</h2>
<p><a href="<?= \Router::get('admin_category_add'); ?>" class="btn btn-primary"><?= __('backend.category.add'); ?></a></p>
<?php if(empty($categories)): ?>
	<?= __('backend.category.empty'); ?>
<?php else: ?>
	<table class="table table-striped">
        <thead>
            <tr>
                <th>
                    ID | Category
                </th>

                <th><?= __('backend.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach($categories as $category): ?>
	            <tr>

	                <td>
                        <a href="<?= \Router::get('admin_category_edit', array('id' => $category->id)); ?>" >
                            <?= $category->id; ?> |
                            <?= $category->name; ?>
                        </a>
                    </td>


	                <td>

	                    <a href="<?= \Router::get('admin_category_delete', array('id' => $category->id)); ?>" class="alert-danger" onclick="return confirm('<?= __('backend.are-you-sure'); ?>')"><?= __('backend.delete'); ?></a>
	                </td>
	            </tr>
        	<?php endforeach; ?>
        </tbody>
    </table>

    <?= $pagination; ?>
<?php endif; ?>