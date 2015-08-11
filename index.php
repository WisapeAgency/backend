<?php
date_default_timezone_set('UTC');
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
require dirname(__FILE__).'/protected/config/custom.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
define('SITE_URL','http://localhost/');
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);

//class Yii extends YiiBase
//{
//    /**
//     * @static
//     * @return CWebApplication
//     */
//    public static function app()
//    {
//        return parent::app();
//    }
//}


Yii::createWebApplication($config)->run();