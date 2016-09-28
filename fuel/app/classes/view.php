<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 4/29/2016
 * Time: 2:38 AM
 */

class View extends \Fuel\Core\View {
    
    public function renderSilent($content)
    {
        return (isset($content) ? $content : '');
    }
}
