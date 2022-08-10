<?php

namespace Flashpoint\Controllers;

class Home extends Controller
{
    /**
     * Method setting the view and headers for the home page
     * @param array $args Leave this array empty - no data are used
     * @return bool TRUE, if the data was set successfully
     */
    public function process(array $args): bool
    {
        self::$data['layout_title'] = 'BlueMaxima\'s Flashpoint';
        self::$data['layout_description'] = 'A webgame preservation project and archive.';
        self::$data['layout_keywords'] = 'Flash, Shockwave, HTML5, Unity, Webgame Preservation, Flash Game Archive, BlueMaxima, DarkMoe';

        self::$views[] = 'home';
        self::$dictionaries[] = 'home';
        self::$cssFiles[] = 'home';
        return true;
    }
}