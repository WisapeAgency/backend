<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 2015/7/9
 * Time: 22:26
 */
class TemplateController extends ApiController{
    public function actionGet(){
        $models = Template::model()->findAllByAttributes('rec_status=:rec_status',array(
            ':rec_status'=>'A'
        ));
        $this->sendDataResponse($models);
    }
}