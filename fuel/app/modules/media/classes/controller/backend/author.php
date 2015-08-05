<?php
namespace Media;

class Controller_Backend_Author extends Controller_Blog
{
    public function action_index()
    {
    	$this->dataGlobal['pageTitle'] = __('backend.category.manage');

        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => \Model_User::count(),
            'per_page'       => floor( \Model_User::count() / 2),
            'uri_segment'    => 'page',
        );
        $this->data['pagination'] = $pagination = \Pagination::forge('authors_pagination', $config);

        // Get categories
        $this->data['authors'] = \Model_User::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();

        return \Response::forge( \View::forge('backend/author/index')->set($this->data, null, false) );

    }
}
