<?php
/**
 * languageSelector extension
 * 
 * @author Leonard Shtika <leonard@shtika.info>
 * @link http://leonard.shtika.info/yii/language-selector
 * @copyright (C) 2012-2014 Leonard Shtika
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('zii.widgets.CPortlet');

/**
 * LsWidget widget class
 */
class LsWidget extends CPortlet
{
    /**
     * Set a new language or load it from a cookie
     */
    public static function loadLanguage()
    {
        if (Yii::app()->request->getPost('languageSelector') != null)
        {
            $newLanguage = Yii::app()->request->getPost('languageSelector');
            
            if (self::validateLanguage($newLanguage))
            {
                // Set a 30 days cookie with the selected language
                $cookie = new CHttpCookie('lang', $newLanguage);
                $cookie->expire = time() + 60 * 60 * 24 * 30;
                Yii::app()->request->cookies['lang'] = $cookie;
            }
        }
        
        // change the default language
        if (isset(Yii::app()->request->cookies['lang']))
        {
            if (self::validateLanguage(Yii::app()->request->cookies['lang']->value))
            {
                Yii::app()->language = Yii::app()->request->cookies['lang']->value;
            }
        }
    }
    
    
    /**
     * Insure that the language from $_POST or $_COOKIE is not hacked
     * @param string $lang (el or el_gr)
     * @return boolean
     */
    private static function validateLanguage($lang)
    {
        if (array_key_exists($lang, Yii::app()->params['availableLanguages']))
        {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Render the Portlet content
     */
    protected function renderContent()
    {
        $availableLanguages = Yii::app()->params['availableLanguages'];
        
        echo '<div id="language_selector_container">';
        foreach ($availableLanguages as $langCode=>$langLabel)
        {
            $selectedLang = ($langCode == Yii::app()->language) ? 'selected' : 'not_selected';
            
            echo CHtml::link($langLabel, Yii::app()->homeUrl, array(
                'submit'=>'',
                'params'=>array('languageSelector'=>$langCode),
                'class'=>$selectedLang,
            ));
            
            // Use | separator, except for the last language
            echo $langLabel === end($availableLanguages) ? '' : ' | ';
        }
        echo '</div>';
    }
}