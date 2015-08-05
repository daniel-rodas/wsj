<?php
namespace Blog;


class Controller_Frontend_Category extends Controller_Blog
{
    public function action_index()
    {
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Category::count(),
            'per_page'       => 3,
            'uri_segment'    => 'page',
        );
        $pagination = \Pagination::forge('categories_pagination', $config);
        // Get categorys
        $this->data['categories'] = Model_Category::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();
        return \Response::forge( \View::forge('frontend/category/index')->set($this->data, null, false) );
    }



    public function action_related_by_article_slug($slug = false)
    {


        $article = Model_Post::query()->where('slug', $slug)->get_one();

        $category = Model_Category::query()->where('id', $article->category_id)->get_one();


        if ( ! $category)
        {
            \Messages::error(__('frontend.category.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
//            // Categorys where category parent is parent category id

            $categories = Model_Category::query()
                ->where('parent_id',  $category->parent_id)
                ->or_where('id',  $category->parent_id)->get();
            $this->data['related_categories'] = $categories;

            return \Response::forge( \View::forge('frontend/category/related/article/slug')->set($this->data, null, false) );
        }
    }


    public function action_by_slug($slug = false)
    {

        $article = Model_Category::query()->select('category_id')
                                    ->where('slug', $slug)->get_one();

        $category = Model_Category::query()->select('name')
                                    ->where('id', $article->category_id)->get_one();

        if ( ! $category)
        {
            \Messages::error(__('frontend.category.not-found'));
        }
        else
        {
            $this->data['section'] = $category->name;
            return \Response::forge( \View::forge('frontend/category/section')->set($this->data, null, false) );
        }
    }

    public function action_show_by_category($category = false)
    {
        $category = $this->data['category'] = Model_Category::query()->where('slug', $category)->get_one();

        if ( ! $category)
        {
            \Messages::error(__('frontend.category.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
            // Pagination
            $config = array(
                'pagination_url' => \Uri::current(),
                'total_items'    => $category->post_count,
                'per_page'       => \Config::get('application.pagination.per_page'),
                'uri_segment'    => 'page',
            );
            $this->data['pagination'] = $pagination = \Pagination::forge('category_pagination', $config);

            // Get posts
            $this->data['categories'] = Model_Category::query()
                                            ->where('category_id', $category->id)
                                            ->order_by('created_at', 'DESC')
//                                            ->offset($pagination->offset)
//                                            ->limit($pagination->per_page)
                                            ->get();
            return \Response::forge( \View::forge('frontend/category/category')->set($this->data, null, false) );
        }
    }

    /**
     * Get all categorys from author
     * @param  string $author username
     */
    public function action_show_by_author($author = false)
    {
        $author = $this->data['author'] = \Model_User::query()->where('username', $author)->get_one();
        if ( ! $author)
        {
            \Messages::error(__('frontend.author.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
            // Pagination
            $config = array(
                'pagination_url' => \Uri::current(),
                'total_items'    => count($author->posts),
                'per_page'       => \Config::get('application.pagination.per_page'),
                'uri_segment'    => 'page',
            );
            $this->data['pagination'] = $pagination = \Pagination::forge('category_pagination', $config);

            // Get categorys
            $this->data['categories'] = Model_Category::query()
                                            ->where('user_id', $author->id)
                                            ->order_by('created_at', 'DESC')
                                            ->offset($pagination->offset)
                                            ->limit($pagination->per_page)
                                            ->get();

                return \Response::forge( \View::forge('frontend/category/author')->set($this->data, null, false) );
        }
    }
}
