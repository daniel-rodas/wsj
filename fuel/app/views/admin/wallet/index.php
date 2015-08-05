<div class="list-group col-md-3">
    <h2>User<?php  echo ( isset($wallet_user) ?  ' - ' . $users[$wallet_user]->email : 's' ); ?></h2>
    <?php if ($users): ?>
        <?php foreach ($users as $item): ?>
            <a href="/admin/wallets/?userId=<?php echo $item->id; ?>"><p
                    class="list-group-item coin-selected-notice">
                    <?php echo $item->email; ?>
                </p></a>


        <?php endforeach; ?>

    <?php else: ?>
        <p>No Users.</p>
    <?php endif; ?>
</div>


<div class="col-md-5 btn-group" id="coin-choice"><!-- Start. Addresses Button Group-->

    <?php if ($wallets):
        $wallets = array_values($wallets);
        ?>
        <h3>Addresses - <?php  echo $user_email =  $wallets[0]->users->email; ?></h3>
        <?php foreach ($wallets as $item): ?>
        <p class="row lead list-group-item">
            <span class="col-md-2">Coin</span>
            <span class="col-md-6">Address</span>
            <span class="col-md-4 ">
                <?php echo Html::anchor('wallet/delete/'.$item->id, 'delete wallet <span class="glyphicon glyphicon-remove"></span>',
                    array(
                        'class' => 'btn btn-danger ',
                        'onclick' => "return confirm('Are you sure you want to delete this wallet?')",
                        'title' => "remove wallet from user",
                        'type' => "button",
                    )); ?>
            </span>
        </p>
            <?php foreach ($item->addresses as $add) : ?>
                <p class="row list-group-item">
                    <span class="col-md-2"><?php  echo $add->coin; ?></span>
                    <span class="col-md-9"><?php  echo $add->address; ?></span>
                    <span class="col-md-1 ">
                        <?php echo Html::anchor('address/delete/'. $add->id, '<span class="glyphicon glyphicon-remove"></span> ',
                            array(
                                'class' => 'btn btn-danger btn-sm alert-danger',
                                'onclick' => "return confirm('Are you sure?')",
                                'title' => "remove address from wallet",
                                'type' => "button",
                            )); ?>
                    </span>
                </p>
            <?php endforeach; ?>

        <?php endforeach; ?>

    <?php else: ?>
        <h3>Crypto Addresses</h3>
        <p class="navbar-text"><?php  echo ( isset($wallet_user) ?  $users[$wallet_user]->email . ' does not have a wallet assigned but you can assign one from bellow. ' : 'Please select a user to view wallet info.' ); ?></p>
        <?php if ( isset($available_wallets) ): ?>
            <?php foreach ($available_wallets as $item): ?>
                <p class="row list-group-item">
                    <span class="col-md-3"><?php  echo $item->id; ?></span>
                    <span class="col-md-3 ">
                        <?php echo Html::anchor('backend/app/assign_wallet/?id=' . $item->id . '&user_id=' . $wallet_user ,
                        '<span class="glyphicon glyphicon-plus"></span> ',
                            array(
                                'class' => 'btn btn-info btn-sm',
                                'title' => "Assign this wallet currently selected user. ",
                                'type' => "button",
                            )); ?>
                    </span>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>

</div><!-- End. Addresses Button Group-->


<div class="col-md-4 "><!-- Create Wallet -->
    <h3>Create New Wallet</h3>

        <p><?php echo ( isset($wallet_user) ? 'Or create a new wallet for ' . $users[$wallet_user]->email . '.' : ' Add crypto addresses to a New Shinny Wallet for later use. ' ) ?></p>

    <?php echo render('backend/admin/wallet/_form', array('wallet_user' =>  isset($wallet_user)?$wallet_user: '' ) ); ?>

</div>