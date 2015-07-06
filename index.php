<?php
date_default_timezone_set('UTC');
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
require dirname(__FILE__).'/protected/config/custom.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
define('SITE_URL','http://loc.wis');
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

$app = Yii::createWebApplication($config);
$rs = Yii::app()->db->createCommand('select * from url_route')->queryAll();
var_dump($rs);
Yii::app()->urlManager->addRules(
    array(
        'dd.html'=>'site/test'
    )
);
$app->run();
//var_dump(Yii::app()->urlManager);exit;