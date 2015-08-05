<?php

/**
 * The Backend Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Backend_Page extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->name = $this->request()->param('name', 'World');
    }
}
