<?php


namespace Flashpoint\Models;

/**
 * Class handling language selection
 */
class LanguageHandler
{

    private const DEFAULT_LANGUAGE = 'en';
    public const AVAILABLE_LANGUAGES = array(
        'cs' => 'Čeština',
        'en' => 'English',
    ); //Temporary value, replace it with the list of all languages later

    /**
     * Loads the language selection from the GET parameter or the language header and saves it to the cookie.
     * If the GET parameter doesn't exist and there is no currently saved language code, language sent from the browser
     * in the http-accept-language is saved.
     * If none of the above is specified, the default language is saved.
     * @param ?string $headerLanguage Language sent from the browser in the http-accept-language header (optional)
     * @return string The language code now saved in the language cookie
     */
    public function loadLanguage(?string $headerLanguage = null): string
    {
        //Is the language specified in the query string (the highest priority)?
        if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys(self::AVAILABLE_LANGUAGES))) {
            $this->setLanguageCookie($_GET['lang']);
            return $_GET['lang'];
        }

        //Is there a previously saved language in the cookie?
        if (!empty($this->readLanguageCookie())) {
            return $this->readLanguageCookie();
        }

        //Is the language cookie empty while there's a language available in the http-accept-language header?
        if (empty($this->readLanguageCookie()) && !empty($headerLanguage)) {
            $languagesArr = $this->parseLanguageHeader($headerLanguage);
            foreach ($languagesArr as $languageCode) {
                if (in_array($languageCode, array_keys(self::AVAILABLE_LANGUAGES))) {
                    $this->setLanguageCookie($languageCode);
                    return $languageCode;
                }
                else if (in_array(substr($languageCode, 0, 2), array_keys(self::AVAILABLE_LANGUAGES))) {
                    $languageCode = substr($languageCode, 0, 2);
                    $this->setLanguageCookie($languageCode);
                    return $languageCode;
                }
            }
        }

        //Nothing is saved and nothing is specified anywhere, we'll just use the default language
        $this->setLanguageCookie(self::DEFAULT_LANGUAGE);
        return self::DEFAULT_LANGUAGE;
    }

    /**
     * Set the specified language code into a cookie, expiring in a year
     * @param string $languageCode Language code to save, should be two characters long
     * @return bool TRUE on success, FALSE on failure
     */
    private function setLanguageCookie(string $languageCode): bool
    {
        return setcookie('lang', $languageCode, time() + 60 * 60 * 24 * 365, '', '', false, true); //Cookie expires in 1 year
    }

    /**
     * Reads and returns the language code saved in the cookie
     * If the cookie doesn't exist, an empty string is returned
     * @return string The saved language code
     */
    private function readLanguageCookie(): string
    {
        return (isset($_COOKIE['lang'])) ? $_COOKIE['lang'] : '';
    }

    /**
     * Function parsing the content of the http-accept-language header into an array of preferred languages
     * @param string $headerContent Value of the header (for example "fr-fr,en-us;q=0.7,en;q=0.3")
     * @return array Numeric array of the preferred languages, from the most preferred to the least (for example
     * array([0] => fr, [1] => en, [2] => en) )
     */
    private function parseLanguageHeader(string $headerContent): array
    {
        //Example value of the header:
        //fr-fr,en-us;q=0.7,en;q=0.3

        //Step 1: split it by commas
        $languageOptions = explode(',', $headerContent);

        //Step 2: get rid of the useless junk
        $languages = array();
        foreach ($languageOptions as $languageOption) {
            //Get the first two characters ("en")
            $lang = substr($languageOption, 0, 2);
            //If the 3rd character is a dash, get the next three characters ("en-US")
            if (strlen($languageOption) > 2 && $languageOption[2] === '-') {
                $lang .= substr($languageOption, 2, 3);
            }
            $languages[] = $lang;
        }

        return $languages;
    }
}
