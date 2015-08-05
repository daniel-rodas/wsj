<div class="panel-heading">
    <h2>Social Accounts</h2>
</div>

<?= View::forge()->render('_includes/message'); ?>
<br>
<div  style="padding: 1.634rem"  class="panel-body">
    <?= View::forge()->render('_includes/message'); ?>
<?php if ($user): ?>
<ul  class="nav nav-pills">
    <li>    <a href="<?= \Router::get('oauth_facebook'); ?>">Connect with Facebook
            <?= Asset::img('social-media/FacebookButton.png', array('alt' => 'Connect with Facebook', 'class' => '')); ?>
        </a></li>
    <li><?= Html::anchor('backend/account/social_disconnect/facebook', 'Disconnect Facebook'); ?></li>
    <li><?= Html::anchor('backend/account/social_disconnect/google', 'Disconnect Google'); ?></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<?php else: ?>
<p>No user.</p>

<?php endif; ?>
</div>