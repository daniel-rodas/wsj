<?php

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Header_Template extends Presenter
{
    protected $userNavigationOptions;

    public function before()
    {
        parent::before();

        if($this->user)
        {
            $this->userNavigationOptions = View::forge('header/dropdown')->set('user', $this->user);
        }
        else
        {
            $this->userNavigationOptions = View::forge('header/login_or_register');
        }
    }

    /**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->navigation = View::forge('header/navigation')->set('userNavigationOptions', $this->userNavigationOptions);
	}
}
