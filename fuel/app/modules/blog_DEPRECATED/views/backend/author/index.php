<h2>Authors</h2>
<?php if(empty($authors)): ?>
	<?= __('backend.category.empty'); ?>
<?php else: ?>
	<table class="table table-striped">
        <thead>
            <tr>
<!--                <th>First</th>-->
<!--                <th>Last</th>-->
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach($authors as $author): ?>

<!--                --><?php //print_r($author);
//                die();
                ?>
	            <tr>
<!--	                <td>--><?//= $author->firstname; ?><!--</td>-->
<!--	                <td>--><?//= $author->lastname; ?><!--</td>-->
	                <td><?= $author->email; ?></td>

	            </tr>
        	<?php endforeach; ?>
        </tbody>
    </table>

    <?= $pagination; ?>
<?php endif; ?>