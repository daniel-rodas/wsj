<form action="/backend/app/add_wallet" method="post" class="container-fluid" role="form" >
    <input type="hidden" name="user_id" <?php echo 'value="' . ( isset($wallet_user) ? $wallet_user : '' ) . '"' ?> />
    <div class="row lead">
        <p class="col-md-6">Coin</p>
        <p class="col-md-6">Address</p>
    </div>
    <fieldset class="row address-entry">
        <div class="col-md-6" >
            <label class="sr-only" for="coin">Coin</label>
            <input type="text" class="form-control" name="coin[]" placeholder="Coin">
        </div>

        <div class="col-md-6 tab-fun">
            <label class="sr-only">Address</label>
            <input type="text" class="form-control" name="address[]" placeholder="Address">
        </div>

    </fieldset>

<!---->
<!---->
<!---->
<!--    <fieldset class="row address-entry">-->
<!--        <div class="col-md-6" >-->
<!--            <label class="sr-only" for="coin">Coin</label>-->
<!--            <input value="GryfenCoin" type="text" class="form-control" name="coin[]" placeholder="Coin">-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-6 tab-fun">-->
<!--            <label class="sr-only">Address</label>-->
<!--            <input type="text" class="form-control" name="address[]" placeholder="Address">-->
<!--        </div>-->
<!---->
<!--    </fieldset>    <fieldset class="row address-entry">-->
<!--        <div class="col-md-6" >-->
<!--            <label class="sr-only" for="coin">Coin</label>-->
<!--            <input value="Bitcoin" type="text" class="form-control" name="coin[]" placeholder="Coin">-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-6 tab-fun">-->
<!--            <label class="sr-only">Address</label>-->
<!--            <input type="text" class="form-control" name="address[]" placeholder="Address">-->
<!--        </div>-->
<!---->
<!--    </fieldset>    <fieldset class="row address-entry">-->
<!--        <div class="col-md-6" >-->
<!--            <label  class="sr-only" for="coin">Coin</label>-->
<!--            <input value="litecoin" type="text" class="form-control" name="coin[]" placeholder="Coin">-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-6 tab-fun">-->
<!--            <label class="sr-only">Address</label>-->
<!--            <input type="text" class="form-control" name="address[]" placeholder="Address">-->
<!--        </div>-->
<!---->
<!--    </fieldset>    <fieldset class="row address-entry">-->
<!--        <div class="col-md-6" >-->
<!--            <label class="sr-only" for="coin">Coin</label>-->
<!--            <input value="darkcoin" type="text" class="form-control" name="coin[]" placeholder="Coin">-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-6 tab-fun">-->
<!--            <label class="sr-only">Address</label>-->
<!--            <input type="text" class="form-control" name="address[]" placeholder="Address">-->
<!--        </div>-->
<!---->
<!--    </fieldset>-->
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success col-md-6 " >Save Wallet</button>
            <a type="button" class="btn btn-info col-md-6 address">Add Another Address</a>
        </div>
    </div>

</form>
