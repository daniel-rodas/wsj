<script type="text/ng-template" id="register.html"  class="panel">
<!--    --><?//= \Form::open(array('action' => 'user/create', 'name' => 'formRegister', 'nonvalidate' , 'class' => 'form-signin', 'ng-class' => 'class')); ?>
    <form name="formRegister" class="form-signin" novalidate method="post" action="authentication/user/register">
        <h2 class="form-signin-heading">Become a Member <span class="small">Step {{step}}</span></h2>


        <div ng-if="step < 3"  ng-controller="SubscriptionOptionsController" class="subscription-options">
            <input type="hidden" name="subscription" value="{{subscription}}"/>
            <tabset type="pills"  justified="true">
                <tab select="setSubscription('classic')" heading="Home Delivery">
                    <h3>Home Delivery</h3>
                    <p><span>12 for 12 Weeks</span>($28.99 monthly thereafter)6-day Paper Delivery,
                        Web Access,
                        Smartphone App,
                        WSJ+ Membership*
                    </p>
                </tab>
                <tab select="setSubscription('digital')"  heading="Digital Only">
                    <h3>Digital Only</h3>
                    <p><span>$12 for 12 Weeks</span>($28.99 monthly thereafter)Tablet Edition,
                        Web Access,
                        Smartphone App,
                        WSJ+ Membership*
                    </p>

                </tab>
                <tab select="setSubscription('ultimate')"  heading="Ultimate Deal">
                    <h3>Ultimate Deal</h3>
                    <p><span>$12 for 12 Weeks</span>($32.99 monthly thereafter)6-day Paper Delivery,
                        Tablet Edition,
                        Web Access,
                        Smartphone App,
                        WSJ+ Membership*
                    </p>

                </tab>
                <tab select="setSubscription('student')"  heading="Student Offers">
                    <h3>Student Offers</h3>
                    <p><span>$15 for 15 Weeks</span></p>

                </tab>

            </tabset>
        </div>

        <fieldset  ng-class="classBasicInfo">

            <div class="form-group">
                <?= Form::label('Email Address', 'username', array('class'=>'control-label')); ?>
                <div class="custom-error" ng-show="formRegister.username.$dirty && formRegister.username.$invalid">
                    <span ng-show="formRegister.username.​$error.pattern">Email Address is required.</span>
                    <span ng-show="formRegister.username.$error.unique">Email already exists.</span>

                </div>
                <div class="custom-success" >
                    <span style="color: green;" ng-show="formRegister.username.$valid" >Checking availability &hellip; </span>

                </div>
                <!-- -->

                <input type="email" class="form-control" name="username"
                       ng-model="username"
                       ng-unique="tableDB.userDBField"
                       ng-pattern="/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i"
                       placeholder="<?= __('user.model.username'); ?>"  required />
            </div>

            <div class="form-group">
                <?= Form::label('Choose Password', 'password', array('class'=>'control-label')); ?>
                <div class="custom-error" ng-show="formRegister.password.$dirty && formRegister.password.$invalid">
                    <span ng-show="formRegister.password.$error.required">Password is required.</span>
                <span ng-show="formRegister.password.$error.pattern">Password is not strong enough. <br />
                    <div style="display:inline-block; height: 4px; width: 10%; background-color: green; margin: 6px 0; padding: 0;"></div>
                    <div style="display:inline-block; height: 4px; width: 20%; background-color: red; margin: 6px 0; padding: 0;"></div>
                    <div style="display:inline-block; height: 4px; width: 40%; background-color: orange; margin: 6px 0; padding: 0;"></div>
                </span>
                </div>
                <div class="custom-success" >
                    <span style="color: green;" ng-show="formRegister.password.$valid">Password is strong. &#10004; <br /><div style="height: 4px; width: 70%; background-color: green; margin: 6px;"></div></span>
                </div>
                <input type="password" ng-model="password"  ng-pattern="/^[a-zA-Z0-9]{8,100}/" class="form-control" name="password" placeholder="<?= __('user.model.password'); ?>" required />
            </div>
        </fieldset>

        <fieldset ng-class="classDeliveryAddress">

            <div class="form-group">
                <label for="delivery_address">Delivery Address</label>
                <input ng-model="delivery_address"  type="text" class="form-control" name="delivery_address" />
            </div>
            <div class="form-group">
                <label for="delivery_address_2">Line 2</label>
                <input ng-model="delivery_address_2"  type="text" class="form-control" name="delivery_address_2" />
            </div>
            <div class="form-group col-md-6">
                <label for="delivery_city">City</label>
                <input ng-model="delivery_city"  type="text" class="form-control" name="delivery_city" />
            </div>
            <div class="form-group col-md-2">
                <label for="delivery_state">State</label>
                <input type="text" ng-model="delivery_state" class="form-control" name="delivery_state" />
            </div>
            <div class="form-group col-md-4">
                <label for="delivery_zip_code">Zip Code</label>
                <input ng-model="delivery_zip_code"  type="text" class="form-control" name="delivery_zip_code" />
            </div>
        </fieldset>

        <fieldset ng-class="classBillingAddress">


            <div class="form-group col-md-7">
                <label for="credit_card_number">Credit Card</label>
                <input ng-model="credit_card_number" type="text" class="form-control" name="credit_card_number" />
            </div>
            <div class="form-group col-md-2">
                <label for="credit_card_csv">CSV</label>
                <input type="text" class="form-control" name="credit_card_csv" />
            </div>
            <div class="form-group col-md-3">
                <label for="credit_card_expiration">Expiration</label>
                <input type="text" class="form-control" name="credit_card_expiration" />

            </div>
            <hr/>

            <div ng-if=" subscription != 'digital' "  class="checkbox">
                <label>
                    <input type="checkbox" checked ng-model="checkboxModel.value1"> <span>Billing Address Same as Delivery</span>
                </label>
            </div>



            <div ng-if="checkboxModel.value1">
                <p><span class="label">Billing Zip Code </span>{{delivery_zip_code}}</p>
            </div>

            <div ng-if="!checkboxModel.value1 ||  subscription == 'digital' ">

                <div class="form-group">
                    <label for="billing_zip_code col-md-8">Zip Code</label>
                    <input type="text" class="form-control" name="billing_zip_code" />
                </div>
            </div>


        </fieldset>
        <section ng-class="classReviewSubscription">
            <h3>Confirm</h3>
            <p><span class="label">Email</span>{{username}}</p>
            <p><span class="label">Type of Subscription</span>{{subscription}}</p>
            <p ng-if="subscription != 'digital' "><span class="label">Delivery Address</span>{{delivery_address}}</p>
            <p><span class="label">Payment Information</span>{{credit_card_number}}</p>
            <p><span class="label">Billing Zip Code </span>{{billing_zip_code}}</p>

        </section>



        <div class="form-group">
            <p ng-class="classSubscriptionComplete" class="text-center">

                <button  type="submit" class="btn btn-primary btn-lg"
                        ng-disabled="formRegister.username.$pristine || formRegister.username.$dirty && formRegister.username.$invalid
                 || formRegister.password.$pristine || formRegister.password.$dirty && formRegister.password.$invalid"
                    >Read the Wall Street Journal </button>
            </p>
            <p ng-if="step < 5 "  class="text-center">
                <button
                    class="btn btn-warning btn-sm" ng-click="back()"  type="button">Back</button>
                <button
                    ng-disabled="step < 2"
                    class="btn btn-info btn-sm" ng-click="skip()"  type="button">Skip</button>
                <button
                    ng-click="changeContinue()"   type="button" class="btn btn-success btn-sm"
                    ng-disabled="formRegister.username.$pristine || formRegister.username.$dirty && formRegister.username.$invalid
                 || formRegister.password.$pristine || formRegister.password.$dirty && formRegister.password.$invalid"
                >{{nextButton}}</button>
            </p>

        </div>
    </form>

    <a ng-click="AC.setTpl('login.html')" >Already a member? Sign In</a>
</script>





