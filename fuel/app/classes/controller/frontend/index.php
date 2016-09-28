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

        // Find post by slug
        $article = Model_Post::query()->select('category_id')
            ->where('slug', $slug)->get_one();

        // Find category to put in header section
        $category = Model_Category::query()->select('name')
            ->where('id', $article->category_id)->get_one();

        $section = $category->name;
        // Set news section the header
        $this->template->header->set('section', $section);

        $post = Model_Post::query()->where('slug', $slug)->get_one();

        if (!\Auth::check())
        {
            $this->template->content = Presenter::forge('article/page', 'viewSnippet')->set('slug', $slug)->set('post', $post);
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
