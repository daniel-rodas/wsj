<?php

namespace Blog;
class Controller_Blog extends \Controller_Hybrid
{
    public function before()
    {
        parent::before();

        // Load translation
        \Lang::load('blog');
    }
}