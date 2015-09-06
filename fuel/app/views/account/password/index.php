<div class="panel-heading">
    <h2>Change Password</h2>
</div>

<div  style="padding: 1.634rem"  class="panel-body">

    <?= Request::forge('authentication/password/update')->execute()->response()->body(); ?>


</div>