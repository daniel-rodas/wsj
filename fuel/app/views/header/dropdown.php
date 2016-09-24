
<li dropdown >
    <a  href id="user-dropdown" dropdown-toggle><?php echo Str::truncate($user->email, 15);  ?> <span class="caret"></span></a>
    <ul class="dropdown-menu" aria-labelledby="user-dropdown">
        <li><a href="<?= \Router::get('backend'); ?>">Exchange</a></li>
        <li><a href="<?= \Router::get('backend_account'); ?>">Account</a></li>
        <li><a href="<?= \Router::get('backend_account_save'); ?>">Saved Items</a></li>
        <li class="divider"></li>
        <li><a href="#">Customer Service</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><?php echo Html::anchor('user/logout','Logout') ?></li>
    </ul>
</li>
