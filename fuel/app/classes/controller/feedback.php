<?php
class Controller_Feedback extends Controller_Backend_Admin
{

	public function action_index()
	{
		$data['feedbacks'] = Model_Feedback::find('all');
		$this->template->title = "Feedbacks";
		$this->template->content = View::forge('feedback/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('feedback');

		if ( ! $data['feedback'] = Model_Feedback::find($id))
		{
			Session::set_flash('error', 'Could not find feedback #'.$id);
			Response::redirect('feedback');
		}

		$this->template->title = "Feedback";
		$this->template->content = View::forge('feedback/view', $data);

	}

	public function action_create()
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

					Response::redirect('feedback');
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

		$this->template->title = "Feedbacks";
		$this->template->content = View::forge('feedback/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('feedback');

		if ( ! $feedback = Model_Feedback::find($id))
		{
			Session::set_flash('error', 'Could not find feedback #'.$id);
			Response::redirect('feedback');
		}

		$val = Model_Feedback::validate('edit');

		if ($val->run())
		{
			$feedback->feedback = Input::post('feedback');
			$feedback->user_id = Input::post('user_id');

			if ($feedback->save())
			{
				Session::set_flash('success', 'Updated feedback #' . $id);

				Response::redirect('feedback');
			}

			else
			{
				Session::set_flash('error', 'Could not update feedback #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$feedback->feedback = $val->validated('feedback');
				$feedback->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('feedback', $feedback, false);
		}

		$this->template->title = "Feedbacks";
		$this->template->content = View::forge('feedback/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('feedback');

		if ($feedback = Model_Feedback::find($id))
		{
			$feedback->delete();

			Session::set_flash('success', 'Deleted feedback #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete feedback #'.$id);
		}

		Response::redirect('feedback');

	}

}
