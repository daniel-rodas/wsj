<?php

namespace Exchange;

class Controller_Market_History extends Controller_Base
{
	public function action_index()
	{
		$this->data['market_histories'] = Model_Market_History::find('all');
        $this->theme->set_partial('content', 'market/history/index')->set($this->data, null, false);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('market/history');

		if ( ! $this->data['market_history'] = Model_Market_History::find($id))
		{
			Session::set_flash('error', 'Could not find market_history #'.$id);
			Response::redirect('market/history');
		}
        $this->theme->set_partial('content', 'market/history/view')->set($this->data, null, false);
    }

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Market_History::validate('create');

			if ($val->run())
			{
				$market_history = Model_Market_History::forge(array(
					'market' => Input::post('market'),
					'coin_id' => Input::post('coin_id'),
					'last_price' => Input::post('last_price'),
					'api_url' => Input::post('api_url'),
				));

				if ($market_history and $market_history->save())
				{
					Session::set_flash('success', 'Added market_history #'.$market_history->id.'.');

					Response::redirect('market/history');
				}

				else
				{
					Session::set_flash('error', 'Could not save market_history.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

        $this->theme->set_partial('content', 'market/history/create');
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('market/history');

		if ( ! $market_history = Model_Market_History::find($id))
		{
			Session::set_flash('error', 'Could not find market_history #'.$id);
			Response::redirect('market/history');
		}

		$val = Model_Market_History::validate('edit');

		if ($val->run())
		{
			$market_history->market = Input::post('market');
			$market_history->coin_id = Input::post('coin_id');
			$market_history->last_price = Input::post('last_price');
			$market_history->api_url = Input::post('api_url');

			if ($market_history->save())
			{
				Session::set_flash('success', 'Updated market_history #' . $id);

				Response::redirect('market/history');
			}

			else
			{
				Session::set_flash('error', 'Could not update market_history #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$market_history->market = $val->validated('market');
				$market_history->coin_id = $val->validated('coin_id');
				$market_history->last_price = $val->validated('last_price');
				$market_history->api_url = $val->validated('api_url');

				Session::set_flash('error', $val->error());
			}
            $this->data['market_history'] = $market_history;
            $this->theme->set_partial('content', 'market/history/edit')->set($this->data, null, false);
		}
        $this->data['market_history'] = $market_history;
        $this->theme->set_partial('content', 'market/history/edit')->set($this->data, null, false);
    }

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('market/history');

		if ($market_history = Model_Market_History::find($id))
		{
			$market_history->delete();

			Session::set_flash('success', 'Deleted market_history #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete market_history #'.$id);
		}

		Response::redirect('market/history');
	}
}
