<?php

/**
 * The Frontpage Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Wallstreet_Page extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */


    public function view()
    {
        /* HMVC call to blog module, then put it in the main content section of the template*/

        $this->content = Request::forge('exchange/option/create', false)->execute()->response()->body();
    }
}
