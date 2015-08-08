<?php

namespace Authentication;

class Model_User extends \Orm\Model_Soft
{
    public static function _init()
    {
        // this is called upon loading the class
        \Module::load('exchange');
    }

    protected static $_properties = array(
        'id',
        'username',
        'password',
        'group_id',
        'email',
        'last_login',
        'login_hash',
        'created_at',
        'updated_at',
        'deleted_at',
    );
    protected static $_table_name = 'users';
    // set up the statistics relation the usual way
//    protected static $_has_one = array('wallet');
    protected static $_has_many = array(
        'transactions' => [

            'model_to' => '\Exchange\Model_Transaction',      // related model
        ],
//        'options',
        'users_metadata' => array(
            'key_from' => 'id',			// key in this model
            'model_to' => 'Authentication\Model_Users_Metadata',      // related model
            'key_to' => 'parent_id',		// key in the related model
            'cascade_save' => true,		// update the related table on save
            'cascade_delete' => true,		// delete the related data when deleting the parent
        ),
        'users_providers' => array(
            'key_from' => 'id',			// key in this model
            'model_to' => 'Authentication\Model_Users_Providers',      // related model
            'key_to' => 'parent_id',		// key in the related model
            'cascade_save' => true,		// update the related table on save
            'cascade_delete' => true,		// delete the related data when deleting the parent
        ),
    );
    // define the EAV container like so
    protected static $_eav = array(
        'users_metadata' => array(			// we use the statistics relation to store the EAV data
            'model_to' => 'Model_Users_Metadata',      // related model
            'attribute' => 'key',		// the key column in the related table contains the attribute
            'value' => 'value',			// the value column in the related table contains the value
        )
    );


    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    


    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('email', 'Email Address', 'required');
        $val->add('password', 'Choose Password:', array('type'=>'password'))->add_rule('required');
        $val->add('password2', 'Re-type Password:', array('type' => 'password'))->add_rule('required');
        $val->field('password')->add_rule('match_value', $val->field('password2')->get_attribute('value'));
        $val->set_message('required', 'The field :field is required');
        $val->set_message('valid_email', 'The field :field must be an email address');
        $val->set_message('match_value', 'The passwords must match');
        return $val;
    }

    public static function validate_basic($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('email', 'Email Address', 'required');
        $val->add_field('firstname', 'First', 'required');
        $val->add_field('lastname', 'Last', 'required');

        $val->set_message('required', 'The field :field is required');
        $val->set_message('valid_email', 'The field :field must be an email address');

        return $val;
    }
    public static function validate_subscription($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('delivery_address', 'Delivery Address', 'required');
        $val->add_field('delivery_address_2', 'Line 2', 'required');
        $val->add_field('delivery_city', 'City', 'required');
        $val->add_field('delivery_state', 'State', 'required');


        return $val;
    }


    public static function create_wallet($userId)
    {
        $wallet =  \Wallet\Model_Wallet::find('first', array(
            'where' => array(
                array('user_id', 'is', null),
            ),
        ));

        if($wallet === null)
        {
            \Session::set_flash('warning', 'Sorry, your wallet could not be created, please contact support.
            Don\'t worry, you can still choose to buy some options.');

            return false;
        }

        $wallet->user_id = $userId;

        if( ! $wallet->save() )
        {
            \Session::set_flash('error', 'There was some technical issue while trying to create your wallet, please contact support. Time to choose some options.');

        }
        else
        {
            \Session::set_flash('success', 'Congratulations, your wallet has been created ! Time to create and buy your first options.');
        }
    }

    public static function register(Fieldset $form)
    {
        $form->add('email', 'E-mail:')->add_rule('required')->add_rule('valid_email');
        $form->add('password', 'Choose Password:', array('type'=>'password'))->add_rule('required');
        $form->add('password2', 'Re-type Password:', array('type' => 'password'))->add_rule('required');
        $form->add('submit', ' ', array('type'=>'submit', 'value' => 'Register'));
        return $form;
    }
    public static function validate_registration(Fieldset $form, $auth)
    {
        $form->field('password')->add_rule('match_value', $form->field('password2')->get_attribute('value'));
        $val = $form->validation();
        $val->set_message('required', 'The field :field is required');
        $val->set_message('valid_email', 'The field :field must be an email address');
        $val->set_message('match_value', 'The passwords must match');

        if ($val->run())
        {
            $password = $form->field('password')->get_attribute('value');
            $email = $form->field('email')->get_attribute('value');
            try
            {
                $user = $auth->create_user($email, $password, $email, 1);
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
            }
            if (isset($user))
            {
                $auth->login($email, $password);
            }
            else
            {
                if (isset($error))
                {
                    $li = $error;
                }
                else
                {
                    $li = 'Something went wrong with creating the user!';
                }
                $errors = Html::ul(array($li));
                return array('e_found' => true, 'errors' => $errors);
            }
        }
        else
        {
            $errors = $val->show_errors();
            return array('e_found' => true, 'errors' => $errors);
        }
    }
}