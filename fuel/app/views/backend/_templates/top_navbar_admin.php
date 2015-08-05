



            <nav>
                <ul class="breadcrumb">
                <li><a href="<?= \Router::get('admin_transaction'); ?>" role="tab">Transactions</a></li>

                <li class=""><a href="<?= \Router::get('admin_option'); ?>" role="tab">Options</a></li>

                <li class=""><a href="<?= \Router::get('admin_coin'); ?>" role="tab">Coins</a></li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">More Actions<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li><a href="<?= \Router::get('logout'); ?>" tabindex="-1" role="tab">Log Out</a></li>
                        <li><a href="<?= \Router::get('backend'); ?>">Trading App</a></li>
                        <li><a href="<?= \Router::get('register'); ?>">Register User</a></li>
                        <li><a href="<?= \Router::get('changepassword'); ?>">Change Password</a></li>
                        <li><a href="<?= \Router::get('admin_wallet'); ?>">Wallets</a></li>
                    </ul>
                </li>
                </ul>
            </nav>





