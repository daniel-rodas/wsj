<li role="presentation" class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Str::truncate($user->email, 15);  ?> <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?= \Router::get('backend_account'); ?>">Account</a></li>
        <li><a href="<?= \Router::get('backend_account_save'); ?>">Saved Items</a></li>
        <li class="divider"></li>
        <li><a href="#">Customer Service</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><?php echo Html::anchor('user/logout','Logout') ?></li>
    </ul>
</li>