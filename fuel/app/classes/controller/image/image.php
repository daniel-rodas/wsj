<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 4/5/2015
 * Time: 2:17 AM
 */

class Controller_Image_Image extends Controller_Frontend_Index
{
    protected function _base64_encode_image($filename = "string" , $filetype = "string")
    {
        $file_size = filesize($filename);
        if($file_size)
        {
            if ( is_readable($filename) )
            {
                $imgbinary = fread(fopen($filename, "r"), filesize($filename));
                return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
            }
        }
        return false;
    }
}
