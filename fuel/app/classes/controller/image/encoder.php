<?php
Class Controller_Image_Encoder extends Controller_Image_Image
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
        // Put navigation view into header
        $this->_header->set('navigation',$this->_navigation);

        // Grab presenter to be used for layout
        $presenter = Presenter::forge('image/page')->set('header',$this->_header);

        /*
         * TODO Grab img URL then encode image
         * return image
         */

        $view = View::forge('image/encoder');
        $presenter->set('content', $view);


        $this->template->content = $presenter;
    }

    public function action_encodeBase64($url, $extension)
    {
        $data['image'] = $this->_base64_encode_image($url, $extension);

        return \Response::forge( \View::forge('image/img')->set_safe($data) );

    }


    public function action_connect_post()
    {
//        Module::load('blog');
//
//        $posts = Blog\Model_Post::query()->limit(15)->get();
//
//        $i = 1;
//        foreach($posts as $post)
//        {
//            $gallery = \Model_Gallery::forge(array(
//                'name' => $post->slug,
//                'post_id' => $post->id,
//                'asset_id' => $i
//            ));
//
//            $gallery->save();
//
//            $i++;
//        }
        $gallery = Model_Gallery::query()->related('asset')->limit(15)->get();
        foreach($gallery as $asset)
        {
            $input_file = DOCROOT . $asset->uri .  $asset->name;
            $image64Encoded = $this->_base64_encode_image($input_file, $asset->type );
            echo 'Name - ' . $asset->name;

            echo '<img src="' .  $image64Encoded . '" alt="' . $asset->name . '" />';
            echo $asset->post_id;
            echo $asset->asset_id;
            echo '<hr />';
        }

        die();
    }

//    protected function _base64_encode_image($filename = "string" , $filetype = "string")
//    {
//        $file_size = filesize($filename);
//        if($file_size)
//        {
//            if ( is_readable($filename) )
//            {
//                $imgbinary = fread(fopen($filename, "r"), filesize($filename));
//                return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
//            }
//        }
//            return false;
//    }

    public function action_base64_encode_image()
    {
        if ($_POST)
        {
            $asciiFormat = Inflector::ascii(Input::post('filename'));
            $webSafeName = Inflector::friendly_title($asciiFormat, '_', true);
            $uploadLocation = 'assets/img/upload/';

            $config = array(
                'auto_process' => 'false',
                'path' => DOCROOT .  $uploadLocation,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                'new_name' => $webSafeName,
                'normalize' => true,
                'change_case' => 'lower',
                'auto_rename' => false,
                'overwrite' => true,
            );
            // process the uploaded files in $_FILES
            Upload::process($config);
            // if there are any valid files
            if (Upload::is_valid())
            {
                // save them according to the config
                Upload::save();
                // Grab the file extension
                $uploadedFile = Upload::get_files(0);

                $filename = $webSafeName . '.' . $uploadedFile['extension'];

                $input_file = $uploadedFile['saved_to'] . $uploadedFile['saved_as'];

                $image64Encoded = $this->_base64_encode_image($input_file, $uploadedFile['extension']);
                $asset = Model_Asset::forge(array(
                    'name' => $uploadedFile['saved_as'],
                    'uri' => $uploadLocation,
                    'type' => $uploadedFile['extension'],
//                    'content' => $image64Encoded,
                ));
                $asset->save();

                return '<img src="' . $image64Encoded . '" />';

            }
            else
            {
                // and process any errors
                foreach (Upload::get_errors() as $key => $file)
                {
                    // $file is an array with all file information,
                    // $file['errors'] contains an array of all error occurred
                    // each array element is an an array containing 'error' and 'message'
//                Session::set_flash('error', $file['errors'] );

                    echo 'Error ' . $key . ' - ';
                    print_r($file['errors']);
                    echo ' <br />';
                }

                die();

            }
        }
        return;
    }

//    public function get_base64_encode_image()
//    {
//        return $this->response = $this->_base64_ecnode_image(\Input::params('filename'), \Input::params('filetype'));
//    }



}