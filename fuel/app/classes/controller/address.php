<?php
class Controller_Address extends Controller_Backend_Admin
{

	public function action_index()
	{
		$data['addresses'] = Model_Address::find('all');
		$this->template->title = "Addresses";
		$this->template->content = View::forge('address/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('address');

		if ( ! $data['address'] = Model_Address::find($id))
		{
			Session::set_flash('error', 'Could not find address #'.$id);
			Response::redirect('address');
		}

		$this->template->title = "Address";
		$this->template->content = View::forge('address/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Address::validate('create');

			if ($val->run())
			{
				$address = Model_Address::forge(array(
					'address' => Input::post('address'),
					'coin' => Input::post('coin'),
				));

				if ($address and $address->save())
				{
					Session::set_flash('success', 'Added address #'.$address->id.'.');

					Response::redirect('address');
				}

				else
				{
					Session::set_flash('error', 'Could not save address.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Addresses";
		$this->template->content = View::forge('address/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('address');

		if ( ! $address = Model_Address::find($id))
		{
			Session::set_flash('error', 'Could not find address #'.$id);
			Response::redirect('address');
		}

		$val = Model_Address::validate('edit');

		if ($val->run())
		{
			$address->address = Input::post('address');
			$address->coin = Input::post('coin');

			if ($address->save())
			{
				Session::set_flash('success', 'Updated address #' . $id);

				Response::redirect('address');
			}

			else
			{
				Session::set_flash('error', 'Could not update address #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$address->address = $val->validated('address');
				$address->coin = $val->validated('coin');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('address', $address, false);
		}

		$this->template->title = "Addresses";
		$this->template->content = View::forge('address/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('address');

		if ($address = Model_Address::find($id))
		{
			$address->delete();

			Session::set_flash('success', 'Deleted address #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete address #'.$id);
		}

		Response::redirect_back('address');

	}

}
