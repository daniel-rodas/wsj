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
    public function view()
    {
        // Check Auth Access
//        if (\Auth::check())
//        {
//            $subscription = Subscription::forge($user);
//            switch ($subscription->getStatus())
//            {
//                case 'new':
//                    $subscription->setStatus('prompt');
//                    break;
//                case 'prompt':
//                    $subscription->infoPrompt();
//                    break;
//                case 'social':
//                    $subscription->decrementPreview();
//                    break;
//                case 'expire':
//                    echo "i equals 0";
//                    break;
//
//            }
//        }

        $snippet = true;
        if (!\Auth::check())
        {
            $data = array();
            $data['facebook_login'] = View::forge('user/facebook');
            $data['form_create'] = Request::forge('user/service/register', false)->execute()->response()->body();
            $data['form_login'] = Request::forge('user/service/login', false)->execute()->response()->body();
            $data['form_recover'] = Request::forge('user/service/recover', false)->execute()->response()->body();

            $this->authentication_form = $data;
        }
        else
        {
            $snippet = false;
        }

        $this->content = Request::forge('blog/frontend/post/show/'. $this->slug )->execute()->response()->body();

        $postId = Request::forge('blog/frontend/post/id_by_slug/' . $this->slug, false)->execute();
        $this->featured_image = Request::forge('media/image/featured/' . $postId, false)->execute()->response()->body();
        $this->related_articles = Request::forge('blog/frontend/post/show_related_by_slug/' . $this->slug, false)->execute()->response()->body();
        $this->related_categories = Request::forge('blog/frontend/category/related_by_article_slug/' . $this->slug, false)->execute()->response()->body();
        $this->more_news =  Request::forge('blog/frontend/post/show_more_news', false)->execute()->response()->body();

    }
}
