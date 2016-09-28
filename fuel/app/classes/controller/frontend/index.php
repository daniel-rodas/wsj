<?php

class Controller_Frontend_Index extends \Controller_Base_Frontend
{
    protected $RnBlogPackage;

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
        \Package::load('Rnblog');
        $this->RnBlogPackage = \Rnblog\Rnblog::forge();

        $section = $this->RnBlogPackage->sectionBySlug($slug);
        // Set news section the header
        $this->template->header->set('section', $section);

        if (!\Auth::check())
        {
            $this->template->content = Presenter::forge('article/page', 'viewSnippet')->set('slug', $slug);
        }
        else
        {
            /*
            $subscription = Subscription::forge($user);
            switch ($subscription->getStatus()) {
                case 'new':
                    $subscription->setStatus('prompt');
                    break;
                case 'prompt':
                    $subscription->infoPrompt();
                    break;
                case 'social':
                    $subscription->decrementPreview();
                    break;
                case 'expire':
                    echo "i equals 0";
                    break;
            }
            */
            $this->template->content = Presenter::forge('article/page')->set('slug', $slug);
        }
    }
}