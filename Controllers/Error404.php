<?php

namespace Flashpoint\Controllers;

class Error404 extends Controller
{
    /**
     * Method setting the view and headers for the error page
     * @param array $args Leave this array empty - no data are used
     * @return bool TRUE, if the data was set successfully
     */
    public function process(array $args): bool
    {
        self::$data['layout_title'] = 'Page not found';
        self::$data['layout_description'] = 'Oops, you probably didn\'t want to end up here.';
        self::$data['layout_keywords'] = '';
        
        self::$views[] = 'error404';
        self::$dictionaries[] = 'error404';
        return true;
    }
}
