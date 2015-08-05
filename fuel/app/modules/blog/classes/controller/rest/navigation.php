<?php
namespace Blog;

class Controller_Rest_Navigation extends Controller_Blog
{
    public function get_navSectionCategories()
    {
        return $this->response = Model_Category::find('all', array(
            'where' => array(
                array('parent_id', null),
            )
        ));
    }

    public function get_navSubCategories()
    {
        /*
         * Initially get sub categories by post slug and default to world category
         * On subsequent requests get sub categories by category slug
         */
        $slug = \Input::get('slug');
        $slugType = \Input::get('slugType'); /* [ post | category ] */

        $category = false;

        if($slugType === 'post')
        {
            $post = Model_Post::query()->where('slug', $slug)->get_one();
            if($post)
            {
                $category = Model_Category::query()->where('id', $post->category_id)->get_one();
                $category = Model_Category::query()->where('id', $category->parent_id)->get_one();

                if(!$category)
                {
                    $category = Model_Category::query()->where('id', $post->category_id)->get_one();
                }
            }
            else
            {
                $cat_id = 1;
                $cat_name = 'world';
            }
        }
        elseif($slugType == 'category')
        {
            $category = Model_Category::query()->where('slug', $slug)->get_one();
        }

        if(!$category){
            $cat_id = 1;
            $cat_name = 'world';
        }
        else
        {
            $cat_id = $category->id;
            $cat_name = $category->name;
        }

        $subCategories = Model_Category::query()
            ->where('parent_id', $cat_id )
            ->get();
        $posts = array();
        $subSections = array();
        $gallery = array();
        $data = array();
        foreach($subCategories as $key => $cat)
        {


            $subCategories[$key]['posts'] = Model_Post::query()->where('category_id', $cat->id)->related('galleries')->limit(3)->get();

            foreach($subCategories[$key]['posts'] as $k => $post)
            {
                $gallery[$key][$k] = \Model_Gallery::query()->where('post_id', $post->id)->related('asset')->get_one();
            }
        }

        $subCategories['section'] = $cat_name;

        return $this->response = $subCategories;
    }
}
