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
        $data = array();
        $data['facebook_login'] = View::forge('user/facebook');
        $data['form_create']  = Request::forge('authentication/user/register', false)->execute()->response()->body();
        $data['form_login']   = Request::forge('authentication/user/login', false)->execute()->response()->body();
        $data['form_recover'] = Request::forge('authentication/password/recover', false)->execute()->response()->body();

        $this->authenticationComponent = View::forge('angular/authentication-component')->set('authentication_form', $data);
        $this->content = Request::forge('blog/frontend/post/show_snippet/'. $this->slug )->execute()->response()->body();
        $this->loadSidebar();
    }

    public function view()
    {
        $this->content = Request::forge('blog/frontend/post/show/'. $this->slug )->execute()->response()->body();
        $this->loadSidebar();
    }

    protected function loadSidebar()
    {
        $postId = Request::forge('blog/frontend/post/id_by_slug/' . $this->slug, false)->execute();
        $this->featured_image = Request::forge('media/image/featured/' . $postId, false)->execute()->response()->body();
        $this->related_articles = Request::forge('blog/frontend/post/show_related_by_slug/' . $this->slug, false)->execute()->response()->body();
        $this->related_categories = Request::forge('blog/frontend/category/related_by_article_slug/' . $this->slug, false)->execute()->response()->body();
        $this->more_news =  Request::forge('blog/frontend/post/show_more_news', false)->execute()->response()->body();
    }
}
