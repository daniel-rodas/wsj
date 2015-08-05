<?php
Class Controller_Image_Advertisement extends Controller_Image_Image
{
    /*
     *
     *  A function I'm using to return local images as base64 encrypted code, i.e. embedding the image source into the html request.
     *
     *  This will greatly reduce your page load time as the browser will only need to send one server request for the entire page,
     *  rather than multiple requests for the HTML and the images. Requests need to be uploaded and 99% of the world are limited on their upload speed to the server.
     *
     */

    public function action_index()
    {

    }

    public function action_banner()
    {
        $banner = Model_Asset::query()->where('id', 22)->get_one();

        $name = $banner->uri . '' . $banner->name;
        $data['image'] = $this->_base64_encode_image($name, $banner->type);

        return \Response::forge( \View::forge('image/advertisement/banner')->set_safe($data) );

    }
}