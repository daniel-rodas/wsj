<?php


class Controller_Frontend_Index extends \Controller_Base_Frontend
{
    protected $blogPackage;

    public function before()
    {
        parent::before();
        $this->blogPackage = \Rodasnet\Blog\Blog::forge();
    }

    public function action_index()
    {
        $this->template->header
            ->set('brand', '' )
            ->set('section', 'Wall Street Journal' );
        /**
         * Home page, featured story
         */
        $this->template->content = Presenter::forge('frontpage/page');
    }

    public function action_article($slug)
    {
        $this->template->title = "Article | Wall Street Journal";

        $article = $this->blogPackage->articleBySlug($slug);

        // Find category to put in header section
        $category = $this->blogPackage->getArticleSection($article);

        // Set news section the header
        $this->template->header->set('section', $category->name);

        if (!\Auth::check())
        {
            $this->template->content =
                Presenter::forge( 'article/page', 'viewSnippet' )
                    ->set( 'slug', $slug )
                    ->set( 'post', $article );
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

            $this->template->content =
                Presenter::forge( 'article/page' )
                    ->set( 'slug', $slug )
                    ->set( 'post', $article );
        }
    }
}
