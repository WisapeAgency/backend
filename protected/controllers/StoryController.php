<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 15-7-22
 * Time: 下午8:47
 */
class StoryController extends Controller{

    public function actionIndex(){
        $this->renderPartial('index');
    }

}