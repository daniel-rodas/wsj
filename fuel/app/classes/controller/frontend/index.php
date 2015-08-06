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

        $this->template->header->set('section', $section);

        // Check Auth Access
//        if (\Auth::check())
//        {
            /*
             *  $subscription = Subscription::forge($user);
            switch ($subscription->getStatus())
            {
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
             *
             *
             *
             */
//        }
        Log::info('Article Index', 'THis is a prof test');
        // Put navigation view into header


        // Grab presenter to be used for layout
        $this->template->content = Presenter::forge('article/page')->set('slug', $slug);

    }
}