<?php

namespace Media;

class Method_Edit extends Method_Template
{
    protected function template ()
    {
        $model = $this->model::forge($this->data);

        if ($model and $model->save()) {
            return $model->id;

        }
        else
        {
           #TODO return errors
            return 'error saving thing.';
        }
        return false;
    }
}
//is_null($id) and Response::redirect('option');
//
//if ( ! $option = Model_Option::find($id))
//{
//    Session::set_flash('error', 'Could not find option #'.$id);
//    Response::redirect('option');
//}
//
//
//$val = Model_Option::validate('edit');
//
//
//
//if ($val->run())
//{
//    if( ! $coin = Model_Coin::query()->where('name', Input::post('coin_name') )->get() )
//    {
//        Session::set_flash('error', 'That coin dosen\'t exit');
//        Response::redirect('option');
//    }
//
//    $coin = array_values($coin);
//    $coin = $coin[0];
//
//    $option->strike = Input::post('strike');
//    $option->coin_id = $coin->id;
//    $option->quantity = Input::post('quantity');
//    $option->price = Input::post('price');
//    $option->category = Input::post('category');
//    $option->expiration_date = Input::post('expiration_date');
//
//    if ($option->save())
//    {
//        Session::set_flash('success', 'Updated option #' . $id);
//
//        Response::redirect('option');
//    }
//
//    else
//    {
//        Session::set_flash('error', 'Could not update option #' . $id);
//    }
//}
//else
//{
//
//    if (Input::method() == 'POST')
//    {
//
//        if( ! $coin = Model_Coin::query()->where('name', Input::post('coin_name') )->get() )
//        {
//            Session::set_flash('error', 'That coin dosen\'t exit');
//            Response::redirect('option');
//        }
//
//        $coin = array_values($coin);
//        $coin = $coin[0];
//
//        $option->strike = $val->validated('strike');
//        $option->coin_id = $coin->id;
//        $option->quantity = $val->validated('quantity');
//        $option->price = $val->validated('price');
//        $option->category = $val->validated('category');
//        $option->expiration_date = $val->validated('expiration_date');
//
//        Session::set_flash('error', $val->error());
//    }
//
//    $data['option'] = $option;
//    $this->template->content = View::forge('option/edit', $data);
//}