<?php

namespace Site\BaseBundle\Languages;

use Ladela\PersonalTranslationsWidgetBundle\TranslationsGetter\TranslationsGetterInterface;

/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 9/12/15
 * Time: 3:35 PM
 */
class LanguagesGetter implements TranslationsGetterInterface
{
    /** @var array */
    protected $languages;

    /**
     * Constructor
     *
     * @param array $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * Gets languages
     *
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}