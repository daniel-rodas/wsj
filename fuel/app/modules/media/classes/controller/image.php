<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 5/5/2015
 * Time: 4:14 PM
 */

namespace Media;


class Controller_Image extends Controller_Base
{


    public function action_featured($id = false)
    {
        $gallery = \Rodasnet\Blog\Model\Gallery::query()->where('post_id', $id)->get_one();
        if(!$gallery)
        {
            return \Response::forge( \View::forge('frontend/post/show/image') );
        }

        $data['url'] = $gallery->asset->uri . '' . $gallery->asset->name ;
        $data['extension'] = $gallery->asset->type;

        $this->data['image_url'] = \Request::forge('image/encoder/encodeBase64')->execute($data)->response()->body();
        return \Response::forge( \View::forge('frontend/post/show/image')->set($this->data, null, false) );
    }

    public function action_edit()
    {
        $data = array();
        $data['images'] = \Rodasnet\Blog\Model\Image::find('all');
        $view = \View::forge('image/index');
//        $index = new Method_Edit($model, $view, $data);
        $index = new Method_Edit($model, $view);
        $this->template->content = $index->template();
    }

    public function action_index()
    {
        $data = array();
        $data['images'] = \Rodasnet\Blog\Model\Image::find('all');

        return \Response::forge( \View::forge('image/index')->set($data, null, false) );
    }
}