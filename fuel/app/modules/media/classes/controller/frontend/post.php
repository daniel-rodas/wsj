<?php
namespace Media;


class Controller_Frontend_Post extends Controller_Blog
{
    public function action_index()
    {
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Post::count(),
            'per_page'       => 3,
            'uri_segment'    => 'page',
        );
        $pagination = \Pagination::forge('post_pagination', $config);
        // Get posts
        $this->data['posts'] = Model_Post::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();
        return \Response::forge( \View::forge('frontend/post/index')->set($this->data, null, false) );
    }

    public function action_show_more_news()
    {
        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items'    => Model_Post::count(),
            'per_page'       => 3,
            'uri_segment'    => 'page',
        );
        $pagination = \Pagination::forge('more_news_pagination', $config);
        // Get posts
        $this->data['posts'] = Model_Post::query()
                                        ->offset($pagination->offset)
                                        ->limit($pagination->per_page)
                                        ->order_by('created_at', 'DESC')
                                        ->get();
        return \Response::forge( \View::forge('frontend/post/show/more')->set($this->data, null, false) );
    }


    public function action_show_related_by_slug($slug = false)
    {
        /**
         * TODO
         * Get all posts from same category as slug
         * @param  string $slug
         */

        $article = Model_Post::query()->where('slug', $slug)->get_one();

        $category = Model_Category::query()->where('id', $article->category_id)->get_one();


        if ( ! $category)
        {
            \Messages::error(__('frontend.post.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
            // Posts where category parent is parent category id

            $this->data['related_articles'] = $posts  = Model_Post::query()->where('slug', '!=', $slug)
                ->rows_limit(3)
                ->related('category')
                ->where('category.parent_id',  $category->parent_id)
                ->or_where('category.id',  $category->parent_id)->get();

            return \Response::forge( \View::forge('frontend/post/show/related')->set($this->data, null, false) );
        }
    }


    public function action_section_by_slug($slug = false)
    {

        $article = Model_Post::query()->select('category_id')
                                    ->where('slug', $slug)->get_one();

        $category = Model_Category::query()->select('name')
                                    ->where('id', $article->category_id)->get_one();

        if ( ! $category)
        {
            \Messages::error(__('frontend.post.not-found'));
        }
        else
        {
            $this->data['section'] = $category->name;
            return \Response::forge( \View::forge('frontend/post/section')->set($this->data, null, false) );
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
            $this->data['posts'] = Model_Post::query()
                                            ->where('category_id', $category->id)
                                            ->order_by('created_at', 'DESC')
//                                            ->offset($pagination->offset)
//                                            ->limit($pagination->per_page)
                                            ->get();
            return \Response::forge( \View::forge('frontend/post/category')->set($this->data, null, false) );
        }
    }

    /**
     * Get all posts from author
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
            $this->data['pagination'] = $pagination = \Pagination::forge('post_pagination', $config);

            // Get posts
            $this->data['posts'] = Model_Post::query()
                                            ->where('user_id', $author->id)
                                            ->order_by('created_at', 'DESC')
                                            ->offset($pagination->offset)
                                            ->limit($pagination->per_page)
                                            ->get();

                return \Response::forge( \View::forge('frontend/post/author')->set($this->data, null, false) );
        }
    }


    public function action_show_featured_image($slug = false)
    {
        // Get post by slug
        $post = $this->data['post'] = Model_Post::query()->where('slug', $slug)->get_one();

        if(! $post)
        {
            echo 'Holly Molly ' . $slug . ' does\'nt have a post';
            die();
        }

        $gallery = \Model_Gallery::query()->where('post_id', $post->id)->get_one();
        if(!$gallery)
        {
            return \Response::forge( \View::forge('frontend/post/show/image') );
        }

        $data['url'] = $gallery->asset->uri . '' . $gallery->asset->name ;
        $data['extension'] = $gallery->asset->type;

        $this->data['image_url'] = \Request::forge('image/encoder/encodeBase64')->execute($data)->response()->body();
               return \Response::forge( \View::forge('frontend/post/show/image')->set($this->data, null, false) );
    }

    public function action_show_featured_story($slug = false)
    {
        // Get post by slug
    	$post = $this->data['post'] = Model_Post::query()->where('id', 25)->get_one();

        $gallery = \Model_Gallery::query()->where('post_id', $post->id)->get_one();
        $data['url'] = $gallery->asset->uri . '' . $gallery->asset->name;
        $data['extension'] = $gallery->asset->type;

        $this->data['featured_image'] = \Request::forge('image/encoder/encodeBase64')->execute($data)->response()->body();

        if ( ! $post)
    	{
    		\Messages::error(__('frontend.post.not-found'));
    		\Response::redirect_back(\Router::get('homepage'));
    	}

               return \Response::forge( \View::forge('frontend/post/show/featured')->set($this->data, null, false) );
    }

    public function action_show($slug = false, $snippet = false)
    {
        $this->data['snippet'] = $snippet;
        // Get post by slug
    	$post = $this->data['post'] = Model_Post::query()->where('slug', $slug)->get_one();

        if ( ! $post)
    	{
    		\Messages::error(__('frontend.post.not-found'));
    		\Response::redirect_back(\Router::get('homepage'));
    	}
    	else
    	{

            // Prepare comment form fieldset
            $form = \Fieldset::forge('post_comment');
            $form->add_model('Blog\Model_Comment');
            $form->add('submit', '', array(
                'type' => 'submit',
                'value' => __('submit'),
                'class' => 'btn btn-primary')
            );

            // If submit comment
            if (\Input::post('submit'))
            {
                $form->validation()->run();

                if ( ! $form->validation()->error())
                {
                    // Create and populate the comment object
                    $comment = Model_Comment::forge();
                    $comment->from_array(array(
                        'username' => $form->validated('username'),
                        'mail' => $form->validated('mail'),
                        'content' => $form->validated('content'),
                        'post_id' => $post->id,
                    ));

                    if ($comment->save())
                    {
                        \Messages::success(__('frontend.comment.added'));
                        \Response::redirect_back(\Router::get('show_post', array('segment' => $post->slug)));
                    }
                    else
                    {
                        \Messages::error(__('error'));
                    }
                }
                else
                {
                    // Output validation errors
                    foreach ($form->validation()->error() as $error)
                    {
                        \Messages::error($error);
                    }
                }
            }
            $form->repopulate();
            $this->data['form'] = $form;
               return \Response::forge( \View::forge('frontend/post/show')->set($this->data, null, false) );
    	}
    }
}
