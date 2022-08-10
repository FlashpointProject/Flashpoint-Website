<?php

namespace Flashpoint\Controllers;

class Platforms extends Controller
{
    /**
     * Method setting the view and headers for the platforms page
     * @param array $args Leave this array empty - no data are used
     * @return bool TRUE, if the data was set successfully
     */
    public function process(array $args): bool
    {
        self::$data['layout_title'] = 'Supported Platforms - BlueMaxima\'s Flashpoint';
        self::$data['layout_description'] = 'A webgame preservation project and archive.';
        self::$data['layout_keywords'] = 'Flash, Shockwave, HTML5, Unity, Webgame Preservation, Flash Game Archive, BlueMaxima, DarkMoe';

        self::$views[] = 'platforms';
        self::$dictionaries[] = 'platforms';
        self::$cssFiles[] = 'platforms';
        return true;
    }
}
