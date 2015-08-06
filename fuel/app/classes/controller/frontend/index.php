<?php

class Controller_Frontend_Index extends \Controller_Base_Frontend
{
    public function action_index()
    {
        /**
         * Home page, featured story
         */
        $this->template->content = Presenter::forge('frontpage/page');
    }

    public function action_article($slug)
    {
        $this->template->title = "Article | Wall Street Journal";
        $section = Request::forge('blog/frontend/post/section_by_slug/' . $slug, false)->execute()->response()->body();

        // Set news section the header
        $this->template->header->set('section', $section);

        // Grab presenter to be used for layout
        $this->template->content = Presenter::forge('article/page')->set('slug', $slug);

    }
}