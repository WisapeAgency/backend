<?php
class PaymentController extends ApiController
{
	/**
	 *  {"date":"09\/09\/2015","order_id":"3CYZDNL-AFV4LD","item":"56599-1","quantity":"1","order_total":"50.01","first_name":"jijun","last_name":"zhang","name":"jijun zhang","company":"","addr1":"shuanglin street","addr2":"","city":"chengdu","state":"Sichuan Sheng","zip":"610000","country":"CN","phone":"","email":"jerry.z@wisape.com","link_id":"","has_tax":"0","ship_country":"CN","ship_state":"Sichuan Sheng","product_name":"????1????","product_price":"50","customer_email_opt_in":"","currency_id":"CNY","currency_total":"349","affiliate_id":"618601","coupon_id":"","vendor_id":"56599","cross_sell":""} 
	 */
	public function actionMycommerce(){
// 		echo json_encode($_REQUEST);exit;
		$model = new PaymentRecord;
		$model->attributes = $_REQUEST;
		if($model->save()){
			echo $model->email;
			exit;
		}
		echo 'error!Please send email to support@wisape.com';
	}
}