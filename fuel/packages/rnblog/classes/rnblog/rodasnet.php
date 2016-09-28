<?php

namespace Rnblog;

class Rnblog_Rodasnet  extends Rnblog_Driver
{
	/**
	* Driver specific functions
	*/
	public function DoSomething()
    {
        return 'I, Rnblog_Rodasnet, AM ALIVE!';
    }

    public function offset($offset, $per_page)
    {
        return Model_Post::query()
            ->offset($offset)
            ->limit($per_page)
            ->order_by('created_at', 'DESC')
            ->get();
    }

    public function id_by_slug($slug = false)
    {
        /**
         * Get all posts from same category as slug
         * @param  string $slug
         */

        $article = Model_Post::query()->where('slug', $slug)->get_one();

        if ( ! $article)
        {
            return false;
        }
        return $article->id;
    }

    public function show_more_news()
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


    public function show_related_by_slug($slug = false)
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


    public function sectionBySlug($slug)
    {
        \Profiler::mark('START_OF section_by_slug query');
        $article = Model\Post::query()->select('category_id')
            ->where('slug', $slug)->get_one();
        \Profiler::mark('END_OF section_by_slug query');

        $category = Model\Category::query()->select('name')
            ->where('id', $article->category_id)->get_one();

        if ( ! $category)
        {
            \Messages::error(__('frontend.post.not-found'));
        }
        else
        {
            return $category->name;
        }
    }

    public function show_by_category($category = false)
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
    public function show_by_author($author = false)
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


    public function show_featured_image($slug = false)
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

    public function show_featured_story($slug = false)
    {
        // Get post by slug
//    	$post = $this->data['post'] = Model_Post::query()->where('id', 157)->get_one();
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


    public function show($slug)
    {
        $post = Model_Post::query()->related('author')->where('slug', $slug)->get_one();
//        $post->author = Model_Author::query()->where('id', $post->user_id )->get_one();
        $this->data['post'] = $post ;

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
    public function show_snippet($slug)
    {
        \Profiler::mark('START_OF show_snippet');
        $post = Model_Post::query()->related('author')->where('slug', $slug)->get_one();
        \Profiler::mark('START_OF show_snippet');
//        $post->author = Model_Author::query()->where('id', $post->user_id )->get_one();
        $this->data['post'] = $post ;

        if ( ! $post)
        {
            \Messages::error(__('frontend.post.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
            return \Response::forge( \View::forge('frontend/post/show/snippet')->set($this->data, null, false) );
        }
    }
}
