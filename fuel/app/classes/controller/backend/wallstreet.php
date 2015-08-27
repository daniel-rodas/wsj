<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/11/2015
 * Time: 1:31 PM
 */

class Controller_Backend_Wallstreet  extends \Controller_Base_Backend
{

    public function action_index()
    {
        $this->template->title = "RN | Wall Street Exchange";

        // Set news section the header
        $this->template->header->set('section', $this->template->title );

        // Grab presenter to be used for layout
        $this->template->content = Presenter::forge('wallstreet/page');
    }

    public function action_sell()
    {
        $obj = $this->exchange->sellOption( \Input::param('id') , \Input::param('price') );
        echo 'Congratulations your option is on sale.';
        echo '<br /><pre>';
        print_r($obj);
    }

    public function action_buy()
    {
        $obj = $this->exchange->buyOption( \Input::param('option')  , \Input::param('user') );
        echo 'Congratulations you purchased an option.';
        echo '<br /><pre>';
        print_r($obj);
    }

    public function action_execute()
    {
        $obj = $this->exchange->executeOption( \Input::param('option')  );
        echo 'Congratulations you executed an option.';
        echo '<br /><pre>';
        print_r($obj);
    }
}