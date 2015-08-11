EAjaxUpload for fiNeUploader
============================

[Fineuploader](https://github.com/Widen/fine-uploader) (ajax uploader) integration with Yii Framework.

Currently supported fineuploader version is 3.4.1 (Released April 1, 2013).

This is a fork of [kosenka/EAjaxUpload](https://github.com/kosenka/EAjaxUpload).

## Changes from original extension

It has been heavily refactored, breaking backward compatibility with original extension:
* Classes have been renamed to avoid amibuity
* `EAjaxUploadWidget` reflects Fineuploader's new API and options
* `qqFileUploadhandler` has been refactored to avoid initialization of optional parameters in the constructor and documented (phpdoc)
* `EAjaxUploadHandlerAction` has been renamed and adapted to meet the new API
* Code has been re-formatted
* Initial README was in Russian and has been renamed to README.ru in favor of this english version.


Note: After this fork gets the required testing, a pull request will be made to the original author.

## Usage

Integration of Fineuploader takes place in two steps:
1. Prepare the client-side javascript using the `EAjaxUploadWidget`
2. Setup the server-side php upload handler using a controller action similar to `EAjaxUploadHandlerAction`

### The client-side javascript widget

Here's a sample usage of the client-side widget, which you'll probably put in a view or other widget.
It's supposed to upload a file to some `photo/ajaxUpload` controller action, which will follow.

The template has been taken from the [bootstraped fineuploader demo](http://fineuploader.com/#bootstrap-demo).

```php
	$this->widget('ext.EAjaxUpload.EAjaxUploadWidget', array(
		'id'=>CHtml::getIdByName('MyAjaxUpload'),
		'config'=>array(
		'validation' => $ajaxValidation,
			// It's mandator that you pass an server-side endpoint which receives the file uploads.
			'request'=>array(
				'endpoint'=>Yii::app()->createUrl('photo/ajaxUpload', array('customGetParam'=>'customGetValue'))
			),
			// You'll probably need to handle completion on the client-side
			'callbacks' => array(
				'onComplete'=>"js:function(id, fileName, responseJSON){ alert('Completed uploading ' + fileName + ' in ' + id); }",
			),
			// Custom uploader template to give it a bootstrap feeling.
			'template' => '<div class="qq-uploader span4">'
					.'<pre class="qq-upload-drop-area"><span>{dragZoneText}</span></pre>'
					.'<div class="qq-upload-button btn btn-success" style="width: auto;">{uploadButtonText}</div>'
					.'<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>'
					.'<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>'
				.'</div>',
			// Fineuploader classes customized for bootstrap
			'classes' => array(
				'success' => 'alert alert-success',
				'fail' => 'alert alert-error'
			),
		)
	));

```

### The server-side upload handler

Now the js is setup, all we need is the controller action to receive the data fineuploader will
be sending.

The sample is taken from `EAjaxUploadHandlerAction` and is practically a wrapper of the `qqFileUploadHandler`
component.

Notice the `$customGetParam` which was passed to the widget configuration above (`request->endpoint field`).

```php
class PhotoController extends CController
{
	public function actionAjaxUpload($customGetParam)
	{
		Yii::import("ext.EAjaxUpload.qqFileUploadHandler");

		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array("jpg");
		// max file size in bytes (1MB here)
		$sizeLimit = 1 * 1024 * 1024;

		$uploadHandler = new qqFileUploadHandler();

		$uploadHandler->setAllowedExtensions($allowedExtensions);
		$uploadHandler->setSizeLimit($sizeLimit);

		$result = $uploadHandler->handleUpload('upload/');

		// to pass data through iframe you will need to encode all html tags
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}

}
```

## References

* [Fineuploader Official Site](http://fineuploader.com/)