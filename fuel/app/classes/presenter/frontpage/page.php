<?php

/**
 * The Frontpage Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Frontpage_Page extends Presenter
{
    public function view()
    {
        $article = $this->blogPackage->showFeaturedArticle();

        $imageEncodedBase64 = $this->blogPackage->showFeaturedImageEncodedBase64($article);

        $this->content = \View::forge('blog/frontend/post/show/featured')
            ->set('post', $article)
            ->set('featured_image', $imageEncodedBase64);

        // Pagination
        $config = array(
            'pagination_url' => \Uri::current(),
            'total_items' => $this->blogPackage->ArticleCount(),
            'per_page' => 3,
            'uri_segment' => 'page',
        );

        $pagination = \Pagination::forge('post_pagination', $config);

        $articlesPaginated = $this->blogPackage->showArticlesPaginated( $pagination );

        $this->secondary_story = \View::forge('blog/frontend/post/index')
            ->set_safe('pagination', $pagination)
            ->set('posts', $articlesPaginated );

        $this->more_news =  \View::forge('blog/frontend/post/show/more')
            ->set('posts', $this->blogPackage->showMoreNews($article) );

    }
}
