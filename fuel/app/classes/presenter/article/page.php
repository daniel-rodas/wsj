<?php

/**
 * The Article Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Article_Page extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function viewSnippet()
    {
        $this->content = View::forge('blog/frontend/post/show/snippet')->set('post', $this->post) ;

//        $this->loadSidebar();
    }

    public function view()
    {
        $this->content = View::forge('blog/frontend/post/show')->set('post', $this->post) ;
//        $this->loadSidebar();
    }

//    protected function loadSidebar()
//    {
//        $postId = Request::forge('blog/frontend/post/id_by_slug/' . $this->slug, false)->execute();
//        $this->featured_image = Request::forge('media/image/featured/' . $postId, false)->execute()->response()->body();
//        $this->related_articles = Request::forge('blog/frontend/post/show_related_by_slug/' . $this->slug, false)->execute()->response()->body();
//        $this->related_categories = Request::forge('blog/frontend/category/related_by_article_slug/' . $this->slug, false)->execute()->response()->body();
//        $this->more_news =  Request::forge('blog/frontend/post/show_more_news', false)->execute()->response()->body();
//    }
}
