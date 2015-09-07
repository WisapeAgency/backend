<?php
class PaymentController extends ApiController
{
	/**
	 * 
	 */
	public function actionMycommerce(){
// 		$order_id = $_REQUEST['order_id'];
		$model = new PaymentRecord;
		$model->attributes = $_REQUEST;
		if($model->save()){
			echo 'success';
			exit;
		}
		echo 'fail';
	}
}