<?php


class Controller_Backend_Index extends \Controller_Base_Backend
{
    /*
     * This controller takes care of rendering the views for logged in users;
     * It call data for New, Options, and Account tabs.
     * The requests for the application is handled by the Controller_Backend_App REST controller.
     */

    public function action_index()
    {
        $this->template->title = 'Backend ';

        $this->template->content = View::forge('backend/index/new/index');
    }

    public function action_option()
    {
        $this->template->title = 'WSJ | RN Options Market';

        /*  Find options the user has bought and now can sell or execute  */
//        $options_sell = Model_Option::find('all', array(
//            'where' => array(
//                array('user_id', '=', $this->_userId),
//                array('expiration_date', '>', DB::expr(time()) ),
//                array('status', '=', 'Sold' ),
//                'or' => array(
//                    array('user_id', '=', $this->_userId),
//                    array('expiration_date', '>', DB::expr(time()) ),
//                    array('status', '=', 'New' ),
//                ),
//            ),
//        ));
//
//        /*  Find options that do not belong to user and is allowed to buy  */
//        $options_buy = Model_Option::find('all', array(
//            'where' => array(
//                array('user_id', '!=', $this->_userId),
//                array('expiration_date', '>', DB::expr(time()) ),
//                array('status', '=', 'Sell' ),
//            ),
//        ));
//
//        $data['optionsSell'] = $options_sell;
//        $data['optionsBuy'] = $options_buy;
        /* set data info views and set views in template */
        $this->template->sell_option = View::forge('backend/index/option/sell');
        $this->template->buy_option = View::forge('backend/index/option/buy');
        $this->template->modal = View::forge('backend/index/option/modal');
    }

    public function action_account()
    {
        $this->template->title = 'RN | WSJ Account';
//        $data['transactions'] = Model_Transaction::find('all');
        $this->template->content = View::forge('user/changepassword');
    }

    public function action_deposit()
    {
        $this->template->title = 'Deposit Gryfencoins into GryfX';
        $data['wallet'] = Model_Wallet::find('all', array(
            'where' => array(
                array('user_id', '=', $this->_userId),
            ),
            'order_by' => array('created_at' => 'desc'),
        ));

        $data['balance'] = Model_Balance::customerBalance($this->_userId);
        $data['balance'] = $data['balance'][0]['balance'];
        $this->template->content = View::forge('backend/index/funds/deposit', $data);
    }

    public function action_sendcoin()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Sendcoin::validate('create');

            if ($val->run())
            {
                $sendcoin = Model_Sendcoin::forge(array(
                    'address' => Input::post('address'),
                    'user_id' => Input::post('user_id'),
                    'quantity' => Input::post('quantity'),
                ));

                if ($sendcoin and $sendcoin->save())
                {
                    Session::set_flash('success', 'Added sendcoin #'.$sendcoin->id.'.');

                    Response::redirect('backend/index/thankyou');
                }

                else
                {
                    Session::set_flash('error', 'Could not save sendcoin.');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $data['addresses'] = Model_Wallet::find('all', array(
            'related' => array(
                'addresses' => array(
                    'where' => array(
                        array('coin', '=', 'GRYF'),
                    ),
                ),
            ),
            'where' => array(
                array('user_id', '=', $this->_userId),
            ),
        ));

        $this->template->title = 'Send Money';
        $data['user_id'] = $this->_userId;
        $this->template->content = View::forge('backend/index/sendcoin/create', $data);
    }
    public function action_feedback()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Feedback::validate('create');

            if ($val->run())
            {
                $feedback = Model_Feedback::forge(array(
                    'feedback' => Input::post('feedback'),
                    'user_id' => Input::post('user_id'),
                ));

                if ($feedback and $feedback->save())
                {
                    Session::set_flash('success', 'Added feedback #'.$feedback->id.'.');

                    Response::redirect('backend/index/thankyou');
                }

                else
                {
                    Session::set_flash('error', 'Could not save feedback.');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = 'We Value your Feedback';
        $data['user_id'] = $this->_userId;

        $this->template->content = View::forge('backend/index/feedback/create', $data);
    }


    public function action_thankyou()
    {
        $this->template->title = 'WSJ | RN Options Market';

        $this->template->content = View::forge('backend/_templates/thankyou');
    }
}