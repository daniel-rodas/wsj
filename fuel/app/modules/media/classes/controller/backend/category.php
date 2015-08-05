<?php
namespace Media;

class Controller_Backend_Category extends Controller_Blog
{
    public function action_index()
    {
    	$this->dataGlobal['pageTitle'] = __('backend.category.manage');

        $per_page = floor( Model_Category::count() / 2 );
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Category::count(),
            'per_page'       =>  $per_page,
//            'per_page'       => \Config::get('application.pagination.per_page'),
            'uri_segment'    => 'page',
        );
        $this->data['pagination'] = $pagination = \Pagination::forge('category_pagination', $config);

        // Get categories
        $this->data['categories'] = Model_Category::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();

        return \Response::forge( \View::forge('backend/category/index')->set($this->data, null, false) );

    }

    public function action_add($id = null)
    {
        $this->data['isUpdate'] = $isUpdate = ($id !== null) ? true : false;

        // Prepare form fieldset
        $form = \Fieldset::forge('category_form', array('form_attributes' => array('class' => 'form-horizontal special')));
        $form->add_model('Blog\Model_Category');

        $form->add('add', '', array(
            'type' => 'submit',
            'value' => ($isUpdate) ? __('backend.edit') : __('backend.add'),
            'class' => 'btn btn-primary')
        );

        // Get or create the post
		if ($isUpdate)
		{
            $this->data['category'] = $category = Model_Category::find($id);
            $this->dataGlobal['pageTitle'] = __('backend.category.edit');
		}
		else
		{
			$this->data['category'] = $category = Model_Category::forge();
	    	$this->dataGlobal['pageTitle'] = __('backend.category.add');
		}

        $form->populate($category);


		// If POST submit
		if (\Input::post('add'))
		{
            $form->validation()->run();

			if ( ! $form->validation()->error())
			{
				// Populate the category
				$category->from_array(array(
					'name' => $form->validated('name'),
                    'slug' => ($form->validated('slug') != '') ? \Inflector::friendly_title($form->validated('slug'), '-', true) : \Inflector::friendly_title($form->validated('name'), '-', true),
                    'parent_id' => $form->validated('parent_id'),
				));

				if ($category->save())
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
//						\Messages::success(__('backend.category.edited'));
                    \Session::set_flash('success',__('backend.category.edited'));
					else
//						\Messages::success(__('backend.category.added'));
                    \Session::set_flash('success',__('backend.category.added'));

					\Response::redirect_back(\Router::get('admin_category'));
				}
				else
				{
//					\Messages::error(__('error'));
                    \Session::set_flash('error',__('error'));
				}
			}
			else
			{
				// Output validation errors		
				foreach ($form->validation()->error() as $error)
				{
                    echo $error;

//					\Messages::error($error);
                    \Session::set_flash('error', $error);
				}
			}
		}
        $form->repopulate();
        $this->data['form'] = $form;

        return \Response::forge( \View::forge('backend/category/add')->set($this->data, null, false) );
    }

    public function action_delete($id = null)
    {
        $category = Model_Category::find($id);
        
        if ($category->delete())
        {
			// Delete cache
			\Cache::delete('sidebar');
        	
            \Messages::success(__('backend.category.deleted'));
        }
        else
        {
            \Messages::error(__('error'));
        }

        \Response::redirect_back(\Router::get('admin_category'));
    }
}
