<?php

class Controller_Backend_App extends \Controller_Base_Backend
{
    public $template = "template";
    protected $response; /* Use variable to hold response back to client */
    protected $_priceHistory;
    protected $_strike;

    protected $_expirationDate; /* Put expiration Date in HERE */

    public function before()
    {
        parent::before();
        /*
         * Since this is a Being used as a REST controller create
         * create a Respsonse object instead of sending back views
         */
        $this->response = \Response::forge();

    }

    public function action_new()
    {
        // Figure out expiration date for option
        if (Input::method() == 'POST')
        {
            $strike = $this->get_strike_price();
            $purchase = $this->get_purchase_price();
             /*
              * Generate serial number for option
              */
            $serial = 'OP' . time() .''.  rand ( 55 , time() );
             /*
             * Create a new Validate instance for new option
             */
            $val = Model_Option::validate_new('create_option');
            if ($val->run(array('serial' => $serial, 'strike' => $strike, 'expiration_date' => $this->_expirationDate,
                'category' => Input::post('option')), true))
            {
                /*
                 * Validation was successful
                 * Now create a new ORM object then
                 * Populate Model_Option with user input then save in DB
                 */
                $option = Model_Option::forge(array(
                    'coin_id' => Input::post('coin_id'),
                    'serial' => $serial,
                    'quantity' => Input::post('quantity'),
                    'price' => $purchase,
                    'strike' => $strike, /* once this value is set it should not change */
                    'category' => Input::post('option'),
                    'status' => 'New', /* status of the option is enum("New","Sell","Sold","Execute"); */
                    'user_id' => $this->_userId, /* user_id is the current owner of an option */
                    'expiration_date' => $this->_expirationDate,
                ))->save();
            }
            else
            {
                Session::set_flash('error', $val->error());
                return $this->response->set_status(500);
            }
        }
        /*
         * Only Contoller_Backend_Index or the Application should access this class
         * Redirect user back to options if the find themselves here by mistake
         */
        Response::redirect('backend/new');
    }

    public function action_sell($id = null)
    {
        $id =  \Input::post('id');
        $price = \Input::post('price');

    /*    When the user sell the option
     *    he can set his own price.
     *    Log the transaction table that user put his option up for sale with a prescribe pirce
     */
        is_null($id) and Response::redirect('option');

        if ( ! $option = Model_Option::find($id))
        {
            Session::set_flash('error', 'Could not find option #'.$id);
            Response::redirect('option');
        }

        $val = Model_Option::validate_sell('edit');

        /*
         * Don't want to overwrite price. If price is empty store var with current price from DB
         */
        if( ! $price )
        {
            $price = $option->price;
        }
        if ($val->run(array( 'price' => $price, 'status' => 'Sell'), true))
        {
            /*
             * Set sale price and update status to Sell in the options market
             */
            $option->price = - abs($price);
            $option->status = 'Sell';
            if ( ! $option->save() )
            {
                Session::set_flash('success', 'Updated option #' . $option->id);
                return $this->response->set_status(500);
            }

            return $this->response->body(json_encode(array('status' => true, 'Location' => 'app/sell')));
        }
    }

    public function action_buy()
    {
        $optionId = \Input::param('id');
        /*
         * Query database to find the option with the option_id from user submit
         */
        $option = Model_Option::find($optionId);

        $val = Model_Option::validate_buy('edit');

        if ($val->run(array( 'status' => 'Sold' ), true))
        {
            $option->status = 'Sold';
            $option->user_id = $this->_userId;

            if ( ! $option->save() )
            {
                Session::set_flash('success', 'Updated option #' . $option->id);
                return $this->response->set_status(500);
            }
            return $this->response->body(json_encode(array('status' => true)));
        }
        /*
         * Only Contoller_Backend_Index or the Application should access this class
         * Redirect user back to options if the find themselves here by mistake
         */
        Response::redirect('backend/option');
    }

    public function action_execute()
    {
        /*
         * User has to pay for the rest of the call option when they execute
         */

        $optionId = \Input::post('id');
        /*
         * Query database to find the option with the option_id from user submit
         */
        $option = Model_Option::find($optionId);

        $val = Model_Option::validate_execute('edit');

        if ($val->run(array( 'status' => 'Execute' ), true))
        {
            $option->status = 'Execute';

            $option->price =  \Market\Market::trade( $option );

            if ( ! $option->save() )
            {
                Session::set_flash('success', 'Updated option #' . $option->id);
                return $this->response->set_status(500);
            }
            return $this->response->body(json_encode(array('status' => true)));
        }
        /*
         * Only Contoller_Backend_Index or the Application should access this class
         * Redirect user back to options if the find themselves here by mistake
         */
        Response::redirect('backend/option');
    }

    public function get_expiration_date()
    {
        // Figure out expiration date for option
        switch (Input::param('timeframe')) {
            case '30m':
                return $this->_expirationDate = time() + ((60 * 60) / 2);

            case '90m':
                return $this->_expirationDate = time() + ((60 * 60) * 1.5);

            case '6h':
                return $this->_expirationDate = time() + (6 * 60 * 60);

            case '1d':
                return $this->_expirationDate = time() + (24 * 60 * 60);

            case '7d':
                return $this->_expirationDate = time() + (7 * 24 * 60 * 60);

            default:
                /*
                * If the user does not pick a set the option to expire at the current time.
                */
                return $this->_expirationDate = time();
        }
    }

    public function get_strike_price()
    {
        $this->get_expiration_date();

        return $this->strike = \Market\Market::strikePrice(Input::param('coin_id'), $this->_expirationDate );
    }

    public function get_purchase_price()
    {
        $this->_strike = $this->get_strike_price();
        return  \Market\Market::purchasePrice( $category = Input::param('option'),
            $strike = $this->_strike , $quantity = Input::param('quantity'),
            $coin_id = Input::param('coin_id'), $action = Input::param('status') );
    }

    public function post_add_wallet()
    {
        if (Input::method() == 'POST')
        {
                $wallet = Model_Wallet::forge();

            if(   empty($_POST['user_id'])  )
            {
                // wallet will be created with no owner no owner
                $wallet->user_id = null;
            }
            else
            {
                // assign wallet to user
                $wallet->user_id = Input::post('user_id');
                unset($_POST['user_id']);
            }

            // all address to wallet model using EAV container
            for ($i = 0; $i < count($_POST['coin']); $i++)
            {
                // If any address entries are empty unset the item from the array and do not save in database
                if( empty($_POST['coin'][$i]) OR empty($_POST['address'][$i])  )
                {
                    unset($_POST['coin'][$i]);
                }
                else
                {
                    $wallet->$_POST['coin'][$i] = $_POST['address'][$i] ;
                }
            }

                if ($wallet and $wallet->save())
                {

                    Session::set_flash('success', 'Added wallet #'.$wallet->id.'.');

                    Response::redirect('admin/wallets');
                }

                else
                {
                    Session::set_flash('error', 'Could not save wallet.');
                }
        }
    }

    public function action_assign_wallet()
    {
        if ( ! $wallet = Model_Wallet::find(Input::get('id')))
        {
            Session::set_flash('error', 'Could not find wallet #'.Input::get('id'));
            Response::redirect('admin/wallets');
        }

        $val = Model_Wallet::validate_assign('edit');

        if ($val->run(array('user_id' => Input::get('id'))))
        {
            $wallet->user_id = Input::get('user_id');

            if ($wallet->save())
            {
                Session::set_flash('success', 'Updated wallet #' . Input::get('id'));

                Response::redirect_back('admin/wallets');
            }

            else
            {
                Session::set_flash('error', 'Could not update wallet #' . Input::get('id'));
            }
        }

        else
        {
            if (Input::method() == 'GET')
            {
                $wallet->user_id = $val->validated('user_id');

                Session::set_flash('error', $val->error());
            }
        }
    }

}