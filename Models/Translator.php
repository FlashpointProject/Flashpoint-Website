<?php


namespace Flashpoint\Models;

class Translator
{

    private const TRANSLATION_FILE_PATH = 'locales/{locale}.json';
    private static array $dictionary;

    public static function loadDictionary($languageCode) : bool
    {
        self::$dictionary = json_decode(file_get_contents('locales/'.$languageCode.'/translation.json'), true);
        return empty(self::$dictionary);
    }

    /**
     * Method reading translation of a specific key from the loaded dictionary and returning it
     * @param string $key Key, under which the translation is saved in the translation file
     * @return string|null The translated string, or NULL, if such key isn't present in the translation file
     */
    public static function translate(string $key) : ?string
    {
        return @self::$dictionary[$key];
    }
}