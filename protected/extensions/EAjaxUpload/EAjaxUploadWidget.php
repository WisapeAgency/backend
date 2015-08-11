<?php
/**
 * EAjaxUpload class file.
 * This extension is a wrapper of http://valums.com/ajax-upload/
 *
 * @author Filios Konstantinos <konfilios@gmail.com>
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class EAjaxUploadWidget extends CWidget
{
	/**
	 * HTML Element id.
	 * @var string
	 */
	public $id = "fileUploader";

	/**
	 * Configuration passed to JS qq.Fineuploader() constructor.
	 * @var array
	 */
	public $config = array();

	/**
	 * Custom fineuploader CSS file.
	 *
	 * Omitting this defaults to the published fineuploader-x.y.z.css
	 * @var string
	 */
	public $css = null;

	/**
	 * Run widget code.
	 *
	 * @throws CException
	 */
	public function run()
	{
		if (empty($this->config['request']['endpoint'])) {
			// Require presence of request endpoint which will handle the server side.
			throw new CException('EAjaxUpload: param "request/endpoint" cannot be empty.');
		}

		// Register js and css file
		$assetsLocalPath = dirname(__FILE__).'/assets';
		$assetsPublishedUrl = Yii::app()->assetManager->publish($assetsLocalPath);
		$this->css = (!empty($this->css)) ? $this->css : $assetsPublishedUrl.'/fineuploader-3.4.1.css';

		// Post parameters appended to ajax call to 'action'
		$postParams = array(
			'PHPSESSID' => session_id(),
			'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken
		);

		// Prepare JS contructor options
		$config = $this->config;
		$config['element'] = 'js:document.getElementById("'.$this->id.'")';
		if (!empty($config['request']['params'])) {
			$config['request']['params'] = array_merge($postParams, $config['request']['params']);
		} else {
			$config['request']['params'] = $postParams;
		}

		// Set the name of the js variable
		$jsObjectName = "FileUploader_".$this->id;

		// Output HTML and JS
		echo '<div id="'.$this->id.'"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div>';
		Yii::app()->clientScript->registerScriptFile($assetsPublishedUrl.'/fineuploader-3.4.1.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerCssFile($this->css);
		Yii::app()->clientScript->registerCssFile($assetsPublishedUrl.'/bootstrap.min.css');
		Yii::app()->getClientScript()->registerScript($jsObjectName,
				"var ".$jsObjectName." = new qq.FineUploader(".CJavaScript::encode($config)."); ", CClientScript::POS_LOAD);
	}
}
