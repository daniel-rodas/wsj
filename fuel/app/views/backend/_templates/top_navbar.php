

<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li>

            <button onclick="window.location.href='<?= \Router::get('backend_new'); ?>'"
                type="button" data-dismiss="modal" class="btn btn-default btn-lg" data-toggle="tooltip"
                    data-placement="top" title="Create & Purchase a customized option from gryfX">
         New
            </button>

    </li>
    <li class="">
            <button onclick="window.location.href='<?= \Router::get('backend_option'); ?>'"
                type="button" data-dismiss="modal" class="btn btn-default btn-lg" data-toggle="tooltip"
                    data-placement="top"
                    title="Sell or Execute on your options or Purchase other people's options they placed for sale">
                Options
            </button>

    </li>
    <li class="dropdown">


            <button onclick="window.location.href='<?= \Router::get('backend_account'); ?>'"
                type="button" class="btn btn-default btn-lg" data-toggle="tooltip" data-placement="top"
                    title="Change your personal settings and default setting for options trading">
                Account
            </button>


    </li>
    <li class="dropdown">

            <button id="myTabDrop1" type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" data-toggle="tooltip" data-placement="right"
                    title="Move GryfenCoins between your wallet and the exchange, or send to friends">Funds
            </button>

        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
            <li><a href="#deposit" onclick="window.location.href='<?= \Router::get('backend_deposit'); ?>'" class="btn btn-default btn-lg" tabindex="-1" role="tab" >Deposit</a>
            </li>
            <li><a href="#send" onclick="window.location.href='<?= \Router::get('backend_sendcoin'); ?>'"
                   class="btn btn-default btn-lg" tabindex="-1" role="tab" >Send</a></li>

            <li><a href="#feedback" onclick="window.location.href='<?= \Router::get('backend_feedback'); ?>'"
                   class="btn btn-default btn-lg" type="button btn-default btn-lg" tabindex="-1"
                   role="tab" >Feedback</a></li>

        </ul>
    </li>
</ul>