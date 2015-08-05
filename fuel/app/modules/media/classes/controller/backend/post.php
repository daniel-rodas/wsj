<?php
namespace Media;

class Controller_Backend_Post extends Controller_Blog
{
    public function before()
    {
        parent::before();
        // Check if the current user is an administrator
        if ( !  \Auth::member(6))
        {
            \Messages::info(__('user.login.permission-denied'));
            \Response::redirect();
        }
    }
    public function action_index()
    {
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Post::count(),
            'per_page'       => 10,
            'uri_segment'    => 'page',
        );
        $this->data['pagination'] = $pagination = \Pagination::forge('post_pagination', $config);
        // Get posts
        $this->data['posts'] = Model_Post::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();
        return \Response::forge( \View::forge('backend/post/index')->set($this->data, null, false) );
    }

    public function action_add($id = null)
    {
        $this->data['isUpdate'] = $isUpdate = ($id !== null) ? true : false;

        // Prepare form fieldset
        $form = \Fieldset::forge('post_form', array('form_attributes' => array('class' => 'form-horizontal btn btn-primary')));
        $form->add_model('Blog\Model_Post');

        $form->add('add', '', array(
            'type' => 'submit',
            'value' => ($isUpdate) ? __('backend.edit') : __('backend.add'),
            'class' => 'btn btn-primary')
        );

        // Get or create the post
		if ($isUpdate)
		{
			$this->data['post'] = $post = Model_Post::find($id);
	    	$this->dataGlobal['pageTitle'] = __('backend.post.edit');
		}
		else
		{
			$this->data['post'] = $post = Model_Post::forge();
	    	$this->dataGlobal['pageTitle'] = __('backend.post.add');
		}

		$form->populate($post);

		// If POST submit
		if (\Input::post('add'))
		{
			$form->validation()->run();

			if ( ! $form->validation()->error())
			{
				// Populate the post
				$post->from_array(array(
					'name' => $form->validated('name'),
					'slug' => ($form->validated('slug') != '') ? \Inflector::friendly_title($form->validated('slug'), '-', true) : \Inflector::friendly_title($form->validated('name'), '-', true),
					'category_id' => $form->validated('category_id'),
					'user_id' => $form->validated('user_id'),
					'content' => $form->validated('content'),
					'original_url' => $form->validated('original_url'),
				));

				if ($post->save())
				{
					// Delete cache
					\Cache::delete('sidebar');

					// Category Post count update
					foreach(Model_Category::find('all') as $category)
					{
						$category->post_count = count($category->posts);
						$category->save();
					}

					if ($isUpdate)
//						\Messages::success(__('backend.post.edited'));
                    \Session::set_flash('success',__('backend.post.edited'));
					else
//						\Messages::success(__('backend.post.added'));
                    \Session::set_flash('success',__('backend.post.added'));

                    \Response::redirect(\Router::get('admin'));
				}
				else
				{
					\Messages::error(__('error'));
                    \Session::set_flash('error',__('error'));
				}
			}
			else
			{
				// Output validation errors		
				foreach ($form->validation()->error() as $error)
				{
					\Messages::error($error);
                    \Session::set_flash('error',__('error'));
				}
			}
		}

		$form->repopulate();
		$this->data['form'] = $form;
		return \Response::forge( \View::forge('backend/post/add')->set($this->data, null, false) );
    }

    public function action_delete($id = null)
    {
        $post = Model_Post::find($id);
        
        if ($post->delete())
        {
			// Delete cache
			\Cache::delete('sidebar');
        	
            \Messages::success(__('backend.post.deleted'));
        }
        else
        {
            \Messages::error(__('error'));
        }

        \Response::redirect_back(\Router::get('admin_post'));
    }

    public function get_articles()
    {
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Post::count(),
            'per_page'       => 3,
            'uri_segment'    => 'page',
        );
        $this->data['pagination'] = $pagination = \Pagination::forge('post_pagination', $config);
        // Get posts
        return $this->response = Model_Post::query()
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->order_by('created_at', 'DESC')
            ->get();
    }

    /**
     * Get the sidebar view (HMVC Only)
     */
    public function get_sidebar()
    {
        if (\Request::is_hmvc())
        {
            // Get sidebar in cache
            try
            {
                $sidebar = \Cache::get('sidebar');
            }
            catch (\CacheNotFoundException $e)
            {
                // If Cache doesn't exist, get data and cache the view
                $this->data['categories'] = Model_Category::find('all');
                $this->data['lastPosts'] = Model_Post::query()->order_by('created_at', 'DESC')->limit(5)->get();
                $sidebar = \View::forge('backend/post/sidebar', $this->data);

                \Cache::set('sidebar', $sidebar);
            }

            return $sidebar;
        }
    }
}
