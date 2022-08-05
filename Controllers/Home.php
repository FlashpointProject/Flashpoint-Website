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
        self::$data['base_title'] = 'BlueMaxima\'s Flashpoint';
        self::$data['base_description'] = 'A webgame preservation project and archive.';
        self::$data['base_keywords'] = 'Flash, Shockwave, HTML5, Unity, Webgame Preservation, Flash Game Archive, BlueMaxima, DarkMoe';

        self::$views[] = 'home';
        return true;
    }
}