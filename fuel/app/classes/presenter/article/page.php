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

        $this->loadSidebar();
    }

    public function view()
    {
        $this->content = View::forge('blog/frontend/post/show')->set('post', $this->post) ;

        $this->loadSidebar();
    }

    protected function loadSidebar()
    {
        // HMVC call to medial module
        $this->featured_image = Request::forge('media/image/featured/' . $this->post->id, false)->execute()->response()->body();

        $this->related_articles = \View::forge('blog/frontend/post/show/related')
            ->set('related_articles', $this->blogPackage->showArticlesRelated($this->post) );

        $this->related_categories = \View::forge('blog/frontend/category/related/article/slug')
            ->set('related_categories', $this->blogPackage->showCategoriesRelated($this->post) );

        $this->more_news =  \View::forge('blog/frontend/post/show/more')
            ->set('posts', $this->blogPackage->showMoreNews($this->post) );
    }
}
