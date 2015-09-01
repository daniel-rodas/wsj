<?php
return array(

	// 'admin' => array('backend/index', 'name' => 'admin'),
	// 'admin/index' => array('backend/index', 'name' => 'admin_index'),
	// 'admin/post' => array('backend/post', 'name' => 'admin_post'),
//	'admin/post/add' => array('blog/backend/post/add', 'name' => 'admin_post_add'),
//	'admin/post/add/(:id)' => array('blog/backend/post/add/$1', 'name' => 'admin_post_edit'),
    'admin/post/delete/(:id)' => array('blog/backend/post/delete/$1', 'name' => 'admin_post_delete'),
    // 'admin/(:any)' => 'backend/$1',

//	'admin/category/add/(:id)' => array('blog/backend/category/add/$1', 'name' => 'admin_category_edit'),
    'category/(:category)' => array('blog/frontend/post/show_by_category/$1', 'name' => 'show_post_category'),
	'author/(:author)' => array('blog/frontend/post/show_by_author/$1', 'name' => 'show_post_author'),

//	'(:segment)' => array('blog/frontend/post/show/$1', 'name' => 'show_post'),


	// Module Blog Routing
	'post' => array('blog/index', 'name' => 'post_index'),
	'post/add' => array('blog/backend/post/add', 'name' => 'post_add'),
	'post/add/(:id)' => array('blog/backend/post/add/$1', 'name' => 'post_edit'),
	'post/delete/(:id)' => array('blog/backend/post/delete/$1', 'name' => 'post_delete'),
);