<?php
class Controller_Wallet extends Controller_Backend_Admin
{

	public function action_index()
	{
		$data['wallets'] = Model_Wallet::find('all');
		$this->template->title = "Wallets";
		$this->template->content = View::forge('wallet/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('wallet');

		if ( ! $data['wallet'] = Model_Wallet::find($id))
		{
			Session::set_flash('error', 'Could not find wallet #'.$id);
			Response::redirect('wallet');
		}

		$this->template->title = "Wallet";
		$this->template->content = View::forge('wallet/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Wallet::validate('create');

			if ($val->run())
			{
				$wallet = Model_Wallet::forge(array(
					'address_id' => Input::post('address_id'),
					'user_id' => Input::post('user_id'),
				));

				if ($wallet and $wallet->save())
				{
					Session::set_flash('success', 'Added wallet #'.$wallet->id.'.');

					Response::redirect('wallet');
				}

				else
				{
					Session::set_flash('error', 'Could not save wallet.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Wallets";
		$this->template->content = View::forge('wallet/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('wallet');

		if ( ! $wallet = Model_Wallet::find($id))
		{
			Session::set_flash('error', 'Could not find wallet #'.$id);
			Response::redirect('wallet');
		}

		$val = Model_Wallet::validate('edit');

		if ($val->run())
		{
			$wallet->address_id = Input::post('address_id');
			$wallet->user_id = Input::post('user_id');

			if ($wallet->save())
			{
				Session::set_flash('success', 'Updated wallet #' . $id);

				Response::redirect('wallet');
			}

			else
			{
				Session::set_flash('error', 'Could not update wallet #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$wallet->address_id = $val->validated('address_id');
				$wallet->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('wallet', $wallet, false);
		}

		$this->template->title = "Wallets";
		$this->template->content = View::forge('wallet/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('wallet');

		if ($wallet = Model_Wallet::find($id))
		{
			$wallet->delete();

			Session::set_flash('success', 'Deleted wallet #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete wallet #'.$id);
		}

		Response::redirect_back('wallet');

	}

}
