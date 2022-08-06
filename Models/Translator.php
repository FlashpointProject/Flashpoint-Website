<?php


namespace Flashpoint\Models;

class Translator
{

    private const TRANSLATION_FILE_PATH = 'locales/{locale}.json';
    private static array $dictionary = array();

    /**
     * Method loading all required translations into a static variable
     * @param string $languageCode Code of the language whose translations are needed
     * @param array $dictionaries Filenames (without extensions) of the dictionary files containing the translations
     * @return bool TRUE, if the loaded static dictionary variable is not empty after loading everything, FALSE otherwise
     */
    public static function loadDictionaries(string $languageCode, array $dictionaries): bool
    {
        foreach ($dictionaries as $dictionary) {
            self::$dictionary = array_merge(
                self::$dictionary,
                json_decode(file_get_contents('locales/'.$languageCode.'/'.$dictionary.'.json'), true)
            );
        }
        return empty(self::$dictionary);
    }

    /**
     * Method reading translation of a specific key from the loaded dictionary and returning it
     * @param string $key Key, under which the translation is saved in the translation file
     * @return string|null The translated string, or NULL, if such key isn't present in the translation file
     */
    public static function translate(string $key): ?string
    {
        return @self::$dictionary[$key];
    }
}