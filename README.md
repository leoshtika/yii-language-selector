Yii languageSelector
=============================

A simple Yii language selector extension 


## Demo

http://leonard.shtika.info/yii/language-selector



## Usage

#### 1) Copy languageSelector folder to the extensions folder (protected/extensions/)


#### 2) Populate the 'params' attribute in the config file (protected/config/main.php) with an array of code/language pairs
``` php
'params'=>array(
    'availableLanguages' => array(
        'el'=>'Ελληνικά', 
        'en'=>'English',
        'it'=>'Italiano', 
        'sq'=>'Shqip', 
    ),
),
```


#### 3) Overwrite the init() method in your main controller class (protected/components/Controller.php)
``` php
public function init()
{
    Yii::import('ext.languageSelector.LsWidget');
    LsWidget::loadLanguage();
    parent::init();
}
```


#### 4) Add this line to your view file where you want to render languageSelector widget
``` php
<?php $this->widget('ext.languageSelector.LsWidget'); ?>
```