<?php

namespace Flashpoint\Controllers;

class Downloads extends Controller
{
    /**
     * Method setting the view and headers for the downloads page
     * @param array $args Leave this array empty - no data are used
     * @return bool TRUE, if the data was set successfully
     */
    public function process(array $args): bool
    {
        self::$data['layout_title'] = 'Downloads - Flashpoint Archive';
        self::$data['layout_description'] = 'A community effort to preserve games and animations from the web.';
        self::$data['layout_keywords'] = 'Flash, Shockwave, HTML5, Unity, Archive, Webgame Preservation, Flash Game Archive, BlueMaxima, DarkMoe';

        self::$views[] = 'downloads';
        self::$dictionaries[] = 'downloads';
        self::$cssFiles[] = 'downloads';
        return true;
    }
}
