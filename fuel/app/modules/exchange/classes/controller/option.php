<?php

namespace Exchange;

class Controller_Option extends Controller_Base
{
    public function action_index()
	{

        $data['options'] =  [( object )['id' => '233', 'serial' => 'faspfdosfo323233', 'expiration_date' => '3445553424', 'strike' => '19999999','category' => 'Cat', 'price' => '189999', 'quantity' => '34',],];
//        $data['options'] = Model_Option::find('all');
        return \Response::forge( \View::forge('option/index', $data) );
    }

	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('option');

		if ( ! $data['option'] = Model_Option::find($id))
		{
			\Session::set_flash('error', 'Could not find option #'.$id);
			\Response::redirect('option');
		}
        return \Response::forge( \View::forge('option/view', $data) );
	}

	public function action_create()
	{


        if (\Input::method() == 'POST')
		{
			if( ! $coin = $this->exchange->getCoin( \Input::post('coin_name') , 'name') )
            {
                \Session::set_flash('error', 'That coin dosen\'t exit');
            }
            /* newOption( $optionType ,  $quantity , $timeFrame , $coinId , $userId ) */
            /*  $this->exchange->newOption( 'Put', '654' , '1d',  4, 5 ); */

			if ( $this->exchange->newOption(  \Input::post('category'), \Input::post('quantity'), \Input::post('time_frame'), $coin->id, $this->user->id ) )
			{

					\Session::set_flash('success', 'Added option');

					\Response::redirect();
            }
			else
			{
				\Session::set_flash('error', 'Good luck next time. ');
			}
		}

        return \Response::forge( \View::forge('option/create') );

	}

	public function action_edit($id = null)
	{
		is_null($id) and \Response::redirect('option');

		if ( ! $option = Model_Option::find($id))
		{
			\Session::set_flash('error', 'Could not find option #'.$id);
			\Response::redirect('option');
		}


		$val = Model_Option::validate('edit');



        if ($val->run())
		{
            if( ! $coin = Model_Coin::query()->where('name', \Input::post('coin_name') )->get() )
            {
                \Session::set_flash('error', 'That coin dosen\'t exit');
                \Response::redirect('option');
            }

            $coin = array_values($coin);
            $coin = $coin[0];

            $option->strike = \Input::post('strike');
			$option->coin_id = $coin->id;
			$option->quantity = \Input::post('quantity');
			$option->price = \Input::post('price');
			$option->category = \Input::post('category');
			$option->expiration_date = \Input::post('expiration_date');

			if ($option->save())
			{
				\Session::set_flash('success', 'Updated option #' . $id);

				\Response::redirect('option');
			}

			else
			{
				\Session::set_flash('error', 'Could not update option #' . $id);
			}
		}
		else
		{

            if (\Input::method() == 'POST')
			{

                if( ! $coin = Model_Coin::query()->where('name', \Input::post('coin_name') )->get() )
                {
                    \Session::set_flash('error', 'That coin dosen\'t exit');
                    \Response::redirect('option');
                }

                $coin = array_values($coin);
                $coin = $coin[0];

                $option->strike = $val->validated('strike');
				$option->coin_id = $coin->id;
				$option->quantity = $val->validated('quantity');
				$option->price = $val->validated('price');
				$option->category = $val->validated('category');
				$option->expiration_date = $val->validated('expiration_date');

				\Session::set_flash('error', $val->error());
			}

            $data['option'] = $option;
            return \Response::forge( \View::forge('option/edit', $data) );
		}

        return \Response::forge( \View::forge('option/edit') );

	}

	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('option');

		if ($option = Model_Option::find($id))
		{
			$option->delete();

			\Session::set_flash('success', 'Deleted option #'.$id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete option #'.$id);
		}

		\Response::redirect('option');

	}
}
