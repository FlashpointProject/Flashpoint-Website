<?php

namespace Flashpoint\Controllers;

use Flashpoint\Models\LanguageHandler;
use Flashpoint\Models\Translator;

class Rooter extends Controller
{
    private const CONTROLLERS_NAMESPACE = 'Flashpoint\\Controllers';
    private const VIEWS_FOLDER = 'Views';

    /**
     * Method processing the request
     * Decides which controller to call depending on the requested URL
     * @param array $args Numeric array containing only one element - the requested URL
     */
    public function process(array $args): bool
    {
        $url = $args[0];
        $url = strtok($url, '?'); //Remove the query string
        $url = preg_replace('/^\/flashpoint\//', '', $url); //Remove containing directory from string
        self::$data['url'] = $url; //Save current url for same-webpage links in the layout view
        $urlArguments = explode('/', $url); //Split the arguments

        $firstArgument = array_shift($urlArguments); //Get the first argument
        if (empty($firstArgument)) {
            $firstArgument = 'index'; //No first argument = we want the homepage
        }

        $routes = parse_ini_file('routes.ini'); //Load defined routes
        $controllerNameAndParams = @$routes[$firstArgument]; //Find out what to do next
        if (empty($controllerNameAndParams)) {
            //Undefined route
            return false;
        }

        $controllerNameAndParams = explode('?', $controllerNameAndParams); //Get list of arguments to pass
        $controllerName = self::CONTROLLERS_NAMESPACE.'\\'.array_shift($controllerNameAndParams); //The first argument is the controller name
        $params = $controllerNameAndParams; //Just rename the variable

        //Handle the language selection
        $languageHandler = new LanguageHandler();
        $languageCode = $languageHandler->loadLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);

        //Process the request
        $controller = new $controllerName(); //Get the next controller (usually the last)
        $result = $controller->process($params); //Pass control to the next controller

        //Load the translations
        Translator::loadDictionaries($languageCode, Controller::$dictionaries);

        return $result;
    }

    /**
     * Method composing the final website from the list of Views and data supplied by specific controllers
     * @return string Final website to send to the user
     */
    public function displayView(): string
    {
        extract(self::$data);

        ob_start();
        require $this->getNextView();
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    /**
     * Method returning a path to the next (more inner) view to display
     * @return string Path to the view
     */
    public function getNextView(): string
    {
        return self::VIEWS_FOLDER.'/'.array_shift(self::$views).'.phtml';
    }
}
