<?php

namespace Exchange;

class Controller_Coin extends Controller_Base
{
    public function action_index()
	{
        $data['coins'] = Model_Coin::find('all');
        return \Response::forge( \View::forge('coin/index')->set($data, null, false)  );
	}

	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('coin');

		if ( ! $data['coin'] = Model_Coin::find($id))
		{
			\Session::set_flash('error', 'Could not find coin #'.$id);
			\Response::redirect('coin');
		}
        return \Response::forge( \View::forge('coin/view', $data) );
	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			/*
			 * Form must include:
			 * enctype="multipart/form-data",
			 */
            // Custom configuration for this upload
            $config = array(
                'auto_process' => 'false',
                'path' => DOCROOT.'public/assets/img/coin',
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                'new_name' => \Input::post('name'),
                'normalize' => true,
                'change_case' => 'lower',
                'auto_rename' => false,
                'overwrite'   => true,
            );
            // process the uploaded files in $_FILES
            \Upload::process($config);
            // if there are any valid files
            if (\Upload::is_valid())
            {
                // save them according to the config
                \Upload::save();
                // Grab the file extension
                $uploadedFile = \Upload::get_files(0);
                $asciiFormat = \Inflector::ascii( \Input::post('name') );
                $webSafeName = \Inflector::friendly_title( $asciiFormat , '_', true );
                $filename = $webSafeName . '.' . $uploadedFile['extension'];


                // Now continue creating the coin for the app
                $val = Model_Coin::validate('create');

                // If Alt tag is user market
                if( \Input::post('alt') == '' )
                {
                    $alt = \Input::post('market');
                }
                else
                {
                    $alt = \Input::post('alt');
                }

                if ($val->run(array('alt' =>$alt, 'file' => $filename, )))
                {
                    $coin = Model_Coin::forge(array(
                        'name' => \Input::post('name'),
                        'file' => $filename,
                        'alt' => $alt,
                        'api' => \Input::post('api'),
                        'market' => \Input::post('market'),
                    ));

                    if ($coin and $coin->save())
                    {
                        \Session::set_flash('success', 'Added coin #'.$coin->id.'.');

                        \Response::redirect('coins');
                    }

                    else
                    {
                        \Session::set_flash('error', 'Could not save coin.');
                    }
                }
                else
                {
                    \Session::set_flash('error', $val->error());
                }
            }
            else
            {
                // and process any errors
                foreach (\Upload::get_errors() as $file)
                {
                    // $file is an array with all file information,
                    // $file['errors'] contains an array of all error occurred
                    // each array element is an an array containing 'error' and 'message'
                    \Session::set_flash('error', $file['errors'] );
                }

            }
		}

		return \Response::forge( \View::forge('coin/create') );
	}

	public function action_edit($id = null)
	{
//        is_null($id) and \Response::redirect('coin');
        is_null($id) and die('No coin ID');

        if ( ! $coin = Model_Coin::find($id))
        {
            \Session::set_flash('error', 'Could not find coin #'.$id);
            \Response::redirect('coin');
        }

        $val = Model_Coin::validate('edit');

		if ($val->run())
		{
			$coin->name = \Input::post('name');
			$coin->file = \Input::post('file');
			$coin->alt = \Input::post('alt');
			$coin->api = \Input::post('api');
			$coin->market = \Input::post('market');

			if ($coin->save())
			{
				\Session::set_flash('success', 'Updated coin #' . $id);

				\Response::redirect('coin');
			}

			else
			{
				\Session::set_flash('error', 'Could not update coin #' . $id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$coin->name = $val->validated('name');
				$coin->alt = $val->validated('alt');
				$coin->file = $val->validated('file');
				$coin->api = $val->validated('api');
				$coin->market = $val->validated('market');

				\Session::set_flash('error', $val->error());
			}

            $data['coins'] = $coin;
            return \Response::forge( \View::forge('coin/edit', $data) );
		}

        return \Response::forge( \View::forge('coin/edit') );

	}

	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('coin');

		if ($coin = Model_Coin::find($id))
		{
			$coin->delete();

			\Session::set_flash('success', 'Deleted coin #'.$id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete coin #'.$id);
		}

		\Response::redirect('coins');

	}

}
