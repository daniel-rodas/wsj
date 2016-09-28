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

    public function sectionBySlug($slug)
    {
        $article = Model\Post::query()->select('category_id')
            ->where('slug', $slug)->get_one();

        $category = Model\Category::query()->select('name')
            ->where('id', $article->category_id)->get_one();

        unset($article);

        if ( ! $category)
        {
            \Messages::error(__('frontend.post.not-found'));
        }
        else
        {
            return $category->name;
        }
    }

    public function showSnippet($slug)
    {
        // TODO compare how Portfolio package handles multiple queries from same table
//        $author = Model\Post::query()->related('author')->where('slug', $slug)->get_one();
//        $author = Model\Post::query()->where('slug', $slug)->get_one();
        $post = Model\Post::query()->where('slug', $slug)->get_one();

//        $post->author = $author;

        var_dump($post->content);
        die();

        if ( ! $post)
        {
            \Messages::error(__('frontend.post.not-found'));
            \Response::redirect_back(\Router::get('homepage'));
        }
        else
        {
            return $post;
        }
    }
