<div class="panel-heading">
    <h2>Change Password</h2>
</div>

<div  style="padding: 1.634rem"  class="panel-body">

    <?= \Request::forge('user/password/update', false)->execute()->response()->body(); ?>


</div>