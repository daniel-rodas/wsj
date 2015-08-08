<?php

namespace Wallet;

class Controller_Balance extends Controller_Base
{

	public function action_index()
	{


        $data['balances'] = Model_Balance::find('all');
		$this->template->title = "Balances";
		$this->template->content = \View::forge('balance/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('balance');

		if ( ! $data['balance'] = Model_Balance::find($id))
		{
			\Session::set_flash('error', 'Could not find balance #'.$id);
			\Response::redirect('balance');
		}

		$this->template->title = "Balance";
		$this->template->content = \View::forge('balance/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Balance::validate('create');

			if ($val->run())
			{
				$balance = Model_Balance::forge(array(
					'description' => Input::post('description'),
					'debit' => Input::post('debit'),
					'credit' => Input::post('credit'),
					'balance' => Input::post('balance'),
				));

				if ($balance and $balance->save())
				{
					\Session::set_flash('success', 'Added balance #'.$balance->id.'.');

					\Response::redirect('balance');
				}

				else
				{
					\Session::set_flash('error', 'Could not save balance.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Balances";
		$this->template->content = \View::forge('balance/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and \Response::redirect('balance');

		if ( ! $balance = Model_Balance::find($id))
		{
			\Session::set_flash('error', 'Could not find balance #'.$id);
			\Response::redirect('balance');
		}

		$val = Model_Balance::validate('edit');

		if ($val->run())
		{
			$balance->description = \Input::post('description');
			$balance->debit = \Input::post('debit');
			$balance->credit = \Input::post('credit');
			$balance->balance = \Input::post('balance');

			if ($balance->save())
			{
				\Session::set_flash('success', 'Updated balance #' . $id);

				\Response::redirect('balance');
			}

			else
			{
				\Session::set_flash('error', 'Could not update balance #' . $id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$balance->description = $val->validated('description');
				$balance->debit = $val->validated('debit');
				$balance->credit = $val->validated('credit');
				$balance->balance = $val->validated('balance');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('balance', $balance, false);
		}

		$this->template->title = "Balances";
		$this->template->content = \View::forge('balance/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('balance');

		if ($balance = Model_Balance::find($id))
		{
			$balance->delete();

			\Session::set_flash('success', 'Deleted balance #'.$id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete balance #'.$id);
		}

		\Response::redirect('balance');

	}

}
