<?php

namespace Exchange;

class Controller_Transactions extends Controller_Base
{

	public function action_index()
	{
        $data['title'] = 'Gangsta';
        $data['transactions'] = Model_Transaction::find('all');
		return \Response::forge( \View::forge('transactions/index', $data) );
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('transactions');

		if ( ! $data['transaction'] = Model_Transaction::find($id))
		{
			Session::set_flash('error', 'Could not find transaction #'.$id);
			Response::redirect('transactions');
		}
        return \Response::forge( \View::forge('transactions/view', $data) );

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Transaction::validate('create');

			if ($val->run())
			{
				$transaction = Model_Transaction::forge(array(
					'user_id' => Input::post('user_id'),
					'option_id' => Input::post('option_id'),
					'action' => Input::post('action'),
					'purchase' => Input::post('purchase'),
				));

				if ($transaction and $transaction->save())
				{
					\Session::set_flash('success', 'Added transaction #'.$transaction->id.'.');

					\Response::redirect('transactions');
				}

				else
				{
					\Session::set_flash('error', 'Could not save transaction.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

        return \Response::forge( \View::forge('transactions/create') );

	}

	public function action_edit($id = null)
	{
		is_null($id) and \Response::redirect('transactions');

		if ( ! $transaction = Model_Transaction::find($id))
		{
			\Session::set_flash('error', 'Could not find transaction #'.$id);
			\Response::redirect('transactions');
		}

		$val = Model_Transaction::validate('edit');

		if ($val->run())
		{
			$transaction->user_id = \Input::post('user_id');
			$transaction->option_id = \Input::post('option_id');
			$transaction->action = \Input::post('action');
			$transaction->purchase = \Input::post('purchase');

			if ($transaction->save())
			{
				\Session::set_flash('success', 'Updated transaction #' . $id);

				\Response::redirect('transactions');
			}

			else
			{
				\Session::set_flash('error', 'Could not update transaction #' . $id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$transaction->user_id = $val->validated('user_id');
				$transaction->option_id = $val->validated('option_id');
				$transaction->action = $val->validated('action');
				$transaction->purchase = $val->validated('purchase');

				\Session::set_flash('error', $val->error());
			}
            $data['transactions'] = $transaction;
            return \Response::forge( \View::forge('transactions/edit', $data) );
        }

        return \Response::forge( \View::forge('transactions/edit') );

	}

	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('transactions');

		if ($transaction = Model_Transaction::find($id))
		{
			$transaction->delete();

			\Session::set_flash('success', 'Deleted transaction #'.$id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete transaction #'.$id);
		}

		\Response::redirect('transactions');

	}

}
