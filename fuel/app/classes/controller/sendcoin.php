<?php
class Controller_Sendcoin extends Controller_Backend_Admin
{

	public function action_index()
	{
		$data['sendcoins'] = Model_Sendcoin::find('all');
		$this->template->title = "Sendcoins";
		$this->template->content = View::forge('sendcoin/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('sendcoin');

		if ( ! $data['sendcoin'] = Model_Sendcoin::find($id))
		{
			Session::set_flash('error', 'Could not find sendcoin #'.$id);
			Response::redirect('sendcoin');
		}

		$this->template->title = "Sendcoin";
		$this->template->content = View::forge('sendcoin/view', $data);

	}

	public function action_create()
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

					Response::redirect('sendcoin');
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

		$this->template->title = "Sendcoins";
		$this->template->content = View::forge('sendcoin/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('sendcoin');

		if ( ! $sendcoin = Model_Sendcoin::find($id))
		{
			Session::set_flash('error', 'Could not find sendcoin #'.$id);
			Response::redirect('sendcoin');
		}

		$val = Model_Sendcoin::validate('edit');

		if ($val->run())
		{
			$sendcoin->address = Input::post('address');
			$sendcoin->user_id = Input::post('user_id');
			$sendcoin->quantity = Input::post('quantity');

			if ($sendcoin->save())
			{
				Session::set_flash('success', 'Updated sendcoin #' . $id);

				Response::redirect('sendcoin');
			}

			else
			{
				Session::set_flash('error', 'Could not update sendcoin #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sendcoin->address = $val->validated('address');
				$sendcoin->user_id = $val->validated('user_id');
				$sendcoin->quantity = $val->validated('quantity');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sendcoin', $sendcoin, false);
		}

		$this->template->title = "Sendcoins";
		$this->template->content = View::forge('sendcoin/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('sendcoin');

		if ($sendcoin = Model_Sendcoin::find($id))
		{
			$sendcoin->delete();

			Session::set_flash('success', 'Deleted sendcoin #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete sendcoin #'.$id);
		}

		Response::redirect('sendcoin');

	}

}
