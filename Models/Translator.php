<?php


namespace Flashpoint\Models;

class Translator
{

    private const TRANSLATION_FILE_PATH = 'locales/{locale}.json';
    private array $dictionary;

    public function loadDictionary($languageCode) : bool
    {
        //TODO
        return false;
    }
}