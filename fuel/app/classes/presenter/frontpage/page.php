<?php

/**
 * The Frontpage Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Frontpage_Page extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */


    public function view()
    {
        /* HMVC call to blog module, then put it in the main content section of the template*/

        $this->content = \Request::forge('blog/frontend/post/show_featured_story', false)->execute()->response()->body();
        $this->secondary_story = \Request::forge('blog/frontend/post', false)->execute()->response()->body();
        $this->more_news = \Request::forge('blog/frontend/post/show_more_news', false)->execute()->response()->body();

    }
}
