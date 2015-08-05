<?php
class Controller_Option extends Controller_Backend_Admin
{
    public function action_index()
	{
        $data['options'] = Model_Option::find('all');
        $this->template->content = View::forge('option/index', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('option');

		if ( ! $data['option'] = Model_Option::find($id))
		{
			Session::set_flash('error', 'Could not find option #'.$id);
			Response::redirect('option');
		}
        $this->template->content = View::forge('option/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			if( ! $coin = Model_Coin::query()->where('name', Input::post('coin_name') )->get() )
            {
                Session::set_flash('error', 'That coin dosen\'t exit');
            }
            $coin = array_values($coin);
            $coin = $coin[0];

            $val = Model_Option::validate('create');
			if ($val->run( array('coin_id' => $coin->id ) ))
			{
                $serial = 'OP' . time() .''.  rand ( 55 , time() );
                $option = Model_Option::forge(array(
					'strike' => Input::post('strike'),
					'serial' => $serial,
					'coin_id' => $coin->id,
					'quantity' => Input::post('quantity'),
					'price' => Input::post('price'),
					'category' => Input::post('category'),
					'action' => 'New',
					'user_id' => $this->_userId,
					'expiration_date' => Input::post('expiration_date'),
				));

				if ($option and $option->save())
				{
					Session::set_flash('success', 'Added option #'.$option->id.'.');

					Response::redirect('option');
				}

				else
				{
					Session::set_flash('error', 'Could not save option.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

        $this->template->content = View::forge('option/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('option');

		if ( ! $option = Model_Option::find($id))
		{
			Session::set_flash('error', 'Could not find option #'.$id);
			Response::redirect('option');
		}


		$val = Model_Option::validate('edit');



        if ($val->run())
		{
            if( ! $coin = Model_Coin::query()->where('name', Input::post('coin_name') )->get() )
            {
                Session::set_flash('error', 'That coin dosen\'t exit');
                Response::redirect('option');
            }

            $coin = array_values($coin);
            $coin = $coin[0];

            $option->strike = Input::post('strike');
			$option->coin_id = $coin->id;
			$option->quantity = Input::post('quantity');
			$option->price = Input::post('price');
			$option->category = Input::post('category');
			$option->expiration_date = Input::post('expiration_date');

			if ($option->save())
			{
				Session::set_flash('success', 'Updated option #' . $id);

				Response::redirect('option');
			}

			else
			{
				Session::set_flash('error', 'Could not update option #' . $id);
			}
		}
		else
		{

            if (Input::method() == 'POST')
			{

                if( ! $coin = Model_Coin::query()->where('name', Input::post('coin_name') )->get() )
                {
                    Session::set_flash('error', 'That coin dosen\'t exit');
                    Response::redirect('option');
                }

                $coin = array_values($coin);
                $coin = $coin[0];

                $option->strike = $val->validated('strike');
				$option->coin_id = $coin->id;
				$option->quantity = $val->validated('quantity');
				$option->price = $val->validated('price');
				$option->category = $val->validated('category');
				$option->expiration_date = $val->validated('expiration_date');

				Session::set_flash('error', $val->error());
			}

            $data['option'] = $option;
            $this->template->content = View::forge('option/edit', $data);
		}

        $this->template->content = View::forge('option/edit', $data);

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('option');

		if ($option = Model_Option::find($id))
		{
			$option->delete();

			Session::set_flash('success', 'Deleted option #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete option #'.$id);
		}

		Response::redirect('option');

	}
}
