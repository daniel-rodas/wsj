<?php

//class Controller_User_Rest extends \Controller
//{
//    public function post_is_unique()
//    {
//        $username = $_POST['username'];
//
//        if($username !== 'daniel.rodas1@yahoo.com')
//        {
//            return json_encode(array(
//                'unique' => true
//            ));
//        }
//
//        return json_encode(array(
//            'unique' => false
//        ));
//    }
//
//}
//
class Controller_Rest_User extends \Controller_Rest
{
    public function post_is_unique()
    {
        if(Input::is_ajax())
        {
//            $this->format = 'json';

            $username = Input::post('username');

            $username = Model_User::query()->where('email', $username)->get_one();

            if($username === null)
            {
                return $this->response(array(
                    'unique' => true
                ));
            }

            return $this->response(array(
                'unique' => false
            ));
        }

        return false;
    }
}
