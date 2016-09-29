<?php

namespace Rnblog;

use Orm\Model;
use Rnblog\Model\Category;
use Rnblog\Model\Post;

class Rnblog_Rodasnet  extends Rnblog_Driver
{
    /**
     * Driver specific functions
     * @param $offset
     * @param $per_page
     * @return
     */

    public function pagination($offset, $per_page)
    {
        return Model_Post::query()
            ->offset($offset)
            ->limit($per_page)
            ->order_by('created_at', 'DESC')
            ->get();
    }

    /**
     * WARNING php 7 syntax!
     * @param Model $article
     * @return Category | null
     */
    public function getArticleSection( Model $article)
    {
        return Category::query()->select('name')->where('id', $article->category_id)->get_one();
    }

    /**
     * WARNING php 7 syntax!
     * @param string $slug
     * @return \Orm\Model
     */
    public function articleBySlug( string $slug )
    {
        return Post::query()->where('slug', $slug)->get_one();
    }
}