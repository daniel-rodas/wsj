<?php

class Controller_Frontend_Index extends \Controller_Base_Frontend
{
    public function before()
    {
        parent::before();

        $this->template->title = "RN | Wall Street Journal";
    }

    public function action_index()
    {
        /**
         * Home page, featured story
         */
        $this->template->content = Presenter::forge('frontpage/page')->set('navigation',$this->_navigation);
    }

    public function action_article($slug)
    {
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
        $this->_header->set('navigation',$this->_navigation);

        // Grab presenter to be used for layout
        $presenter = Presenter::forge('article/page')->set('header',$this->_header)->set('slug', $slug);
        $this->template->content = $presenter;
    }
}